<?php

namespace App\Http\Controllers\API;

use App\Models\Galeria;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\GaleriaRequest;

class GaleriaController extends Controller
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
            'count_galeria' => Galeria::latest()->count(),
            'menu'       => 'admin.menu.v_menu_admin',
            'content'    => 'admin.content.view_galeria',
            'title'    => 'Tabla Galeria'
        ];

        if ($request->ajax()) {
            $q_user = Galeria::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editGaleria"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteGaleria"><i class="fi-rr-trash"></i></div>';
 
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
    public function store(GaleriaRequest $request)
    {
        if($request->id !== null){

            $galeria = Galeria::find($request->id);

            $currentPhoto = $galeria->imagen;

            if ($request->imagen != $currentPhoto) {
                $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos($request->imagen, ';')))[1])[1];
    
                \Image::make($request->imagen)->save(public_path('images/Galeria/').$name);
                $request->merge(['imagen' => $name]);
    
                $userPhoto = public_path('images/Galeria/') . $currentPhoto;
                if (file_exists($userPhoto)) {
                    @unlink($userPhoto);
                }
            }
        }else{
        if($request->imagen){
            $name = time().'.' . explode('/', explode(':', substr($request->imagen, 0, strpos
            ($request->imagen, ';')))[1])[1];

           \Image::make($request->imagen)->save(public_path('images/Galeria/').$name);
           $request->merge(['imagen' => $name]);

        }
    }
        Galeria::updateOrCreate(['id' => $request->id],
                [
                 'titulo' => $request->titulo,
                 'descripcion' => $request->descripcion,
                 'categoria' => $request->categoria,
                 'imagen' => $request->imagen,
                ]);        

        return response()->json(['success'=>'Galeria Guardado!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $galeria = Galeria::find($id);

        return response()->json($galeria);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galeria $galeria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeria  $galeria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galeria = Galeria::FindOrFail($id);
        if(file_exists('images/Galeria/'. $galeria->imagen) AND !empty($galeria->imagen)){
              unlink('images/Galeria/'. $galeria->imagen);
           }
              try{

                $galeria->delete();
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
