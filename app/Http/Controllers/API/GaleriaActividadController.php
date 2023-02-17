<?php

namespace App\Http\Controllers\API;

use App\Models\GaleriaActividad;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\GaleriaActividadRequest;

class GaleriaActividadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'count_galeriaActividad' => GaleriaActividad::latest()->count(),
            'menu'       => 'admin.menu.v_menu_admin',
            'content'    => 'admin.content.view_galeriaActividad',
            'title'    => 'Tabla GaleriaActividad'
        ];

        if ($request->ajax()) {
            $q_user = GaleriaActividad::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editGaleriaActividad"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteGaleriaActividad"><i class="fi-rr-trash"></i></div>';

                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.layouts.v_template',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GaleriaActividadRequest $request)
    {
        if($request->id !== null){

            $galeriaActividad = GaleriaActividad::find($request->id);

            $currentPhoto = $galeriaActividad->imagen;

            if ($request->imagen != $currentPhoto) {
                $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];
    
                \Image::make($request->imagen)->save(public_path('images/GaleriaActividad/').$name);
                $request->merge(['imagen' => $name]);
    
                $userPhoto = public_path('images/GaleriaActividad/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }
            }
        }else{
        if($request->imagen){
            $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
            ($request->imagen, ';')))[1])[1];

           \Image::make($request->imagen)->save(public_path('images/GaleriaActividad/').$name);
           $request->merge(['imagen' => $name]);

        }
    }
        GaleriaActividad::updateOrCreate(['id' => $request->id],
                [
                 'titulo' => $request->titulo,
                 'descripcion' => $request->descripcion,
                 'fecha' => $request->fecha,
                 'categoriaImg' => $request->categoriaImg,
                 'imagen' => $request->imagen,
                ]);

        return response()->json(['success'=>'Guardado con exito!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GaleriaActividad  $galeriaActividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $galeriaActividad = GaleriaActividad::find($id);

        return response()->json($galeriaActividad);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GaleriaActividad  $galeriaActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GaleriaActividad $galeriaActividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaleriaActividad  $galeriaActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeriaActividad = GaleriaActividad::FindOrFail($id);
        if(file_exists('images/GaleriaActividad/'. $galeriaActividad->imagen) AND !empty($galeriaActividad->imagen)){
              unlink('images/GaleriaActividad/'. $galeriaActividad->imagen);
           }
              try{

                $galeriaActividad->delete();
                $bug = 0;
              }
              catch(\Exception $e){
                  $bug = $e->errorInfo[1];
              }
              if($bug==0){
                  echo "success";
              }else{
                  echo 'error';
              }
    }
}