<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use DataTables;
use App\Models\ReservaCapacitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ReservarCapacitacionRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Capacitacion;

class ReservaCapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     } 
 
     public function index(Request $request)
     {
         $data = [
             'count_reserva' => ReservaCapacitacion::latest()->count(),
             'menu'       => 'admin.menu.v_menu_admin',
             'content'    => 'admin.content.view_reservarCapacitacion',
             'title'    => 'Tabla Reservar'
         ];
         $capacitacion = DB::table('capacitacions')->get();
         if ($request->ajax()) {
             $q_user = ReservaCapacitacion::select('*')->orderByDesc('created_at');
             return Datatables::of($q_user)
                     ->addIndexColumn()
                     ->addColumn('action', function($row){
      
                         $btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editReserva"><i class=" fi-rr-edit"></i></div>';
                         $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteReserva"><i class="fi-rr-trash"></i></div>';
  
                          return $btn;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }
 
         return view('admin.layouts.v_template',$data, compact('capacitacion'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservarCapacitacionRequest $request)
    {
        $capacitacion = Capacitacion::FindOrFail($request->idCapacitacion);

        ReservaCapacitacion::updateOrCreate(['id' => $request->id],
                [
                'idCapacitacion' => $request->idCapacitacion,
                 'nombre' => $request->nombre,
                 'apellido1' => $request->apellido1,
                 'apellido2' => $request->apellido2,
                 'celular' => $request->celular,
                 'email' => $request->email,
                ]);        

                $details=[
                    'tittle' => 'Confirmación de reservación',
                    'body' => "Reservacion realizada para la capacitacion $capacitacion->nombre en la fecha $capacitacion->horario y hora $capacitacion->hora en la modalidad $capacitacion->modalidad el tema es $capacitacion->tema"
                ];

                Mail::to($request->email)->send(new TestMail($details));

        return response()->json(['success'=>'Accion completada!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservaCapacitacion  $reservaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function show(ReservaCapacitacion $reservaCapacitacion)
    {
        //
    }
    public function edit(Request $request, $id)
    {
        
        $reservaCapacitacion = ReservaCapacitacion::find($id);

        return response()->json($reservaCapacitacion);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservaCapacitacion  $reservaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservaCapacitacion $reservaCapacitacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservaCapacitacion  $reservaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $reservaCapacitacion = ReservaCapacitacion::FindOrFail($id);
              try{

                  $reservaCapacitacion->delete();
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
