<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Capacitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\CapacitacionRequest;

class CapacitacionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $data = [
            'count_capacitacion' => Capacitacion::latest()->count(),
            'menu'       => 'admin.menu.v_menu_admin',
            'content'    => 'admin.content.view_capacitacion',
            'title'    => 'Tabla Capacitación'
        ];

        if ($request->ajax()) {
            $q_user = Capacitacion::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editCapacitaciones"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteCapacitacion"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.layouts.v_template',$data);
    }

    public function store(CapacitacionRequest $request)
    {

        Capacitacion::updateOrCreate(['id' => $request->id],
                [
                 'nombre' => $request->nombre,
                 'modalidad' => $request->modalidad,
                 'horario' => $request->horario,
                 'hora' => $request->hora,
                 'tema' => $request->tema,
                ]);        

        return response()->json(['success'=>'Accion completada!']);
    }

    public function edit(Request $request, $id)
    {
        $capacitacion = Capacitacion::find($id);

        return response()->json($capacitacion);

    }




    public function destroy($id)
    {
       
        $capacitacion = Capacitacion::FindOrFail($id);
              try{

                  $capacitacion->delete();
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