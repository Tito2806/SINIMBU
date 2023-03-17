<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\GaleriaActividad;
use App\Models\Galeria;
use App\Models\ReservaCapacitacion;
use App\Http\Requests\Admin\ReservarCapacitacionRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Capacitacion;

class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Client.inicio');
    }
    public function acerca()
    {
        return view('Client.acerca');
    }

    public function actividades()
    {
        $actividad = DB::table('actividads')->paginate(2);
		return view('Client.actividades', compact('actividad'));
    }

    public function galeriaActividad()
    {
        $galeriaActividad = DB::table('galeriaactividads')->paginate(2);
		return view('Client.galeriaActividad', compact('galeriaActividad'));
    }
    public function galeriaActividadFiltro(Request $request)
    {        $filtro = $request->nombreFiltro;
        $galeriaActividadFiltro  = GaleriaActividad::select('*')->where('categoriaImg', 'LIKE', '%'.$filtro.'%')->paginate(6);
            return view('Client.galeriaActividadFiltro', compact('galeriaActividadFiltro'));
    }
    public function galeria()
    {        
            $galeria = DB::table('galerias')->paginate(2);
            return view('Client.galeria', compact('galeria'));
    }

    public function galeriaFiltro(Request $request)
    {        $filtro = $request->nombreFiltro;
        $galeriaFiltro = Galeria::select('*')->where('categoria', 'LIKE', '%'.$filtro.'%')->paginate(1);
            return view('Client.galeriaFiltro', compact('galeriaFiltro'));
    }


    public function capacitacionInfo() //tried emulating process to render capacitacionInfo view
    {
        $capacitacion = DB::table('capacitacions')->paginate(3);
        return view('Client.capacitacionInfo',compact('capacitacion'));
    }

    public function repositorio() //tried emulating process to render capacitacionInfo view
    {
        $repositorio = DB::table('repositorio_archivos')->paginate(6);
       // dd($repositorio);
        return view('Client.repositorio', compact('repositorio'));
    }

    public function reservarCapacitacion($idCapacitacion) //tried emulating process to render capacitacionInfo view
    {
        $capacitacion = DB::table('capacitacions')->where('id', $idCapacitacion)->first();
        //dd($capacitacion);
        return view('Client.capacitacionFormulario', compact('capacitacion'));

    }


    public function reservaCliente(ReservarCapacitacionRequest $request)
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

                $email = $request->email;

                $messages = "Reservacion realizada para la capacitacion $capacitacion->nombre en la fecha $capacitacion->horario y hora $capacitacion->hora en la modalidad $capacitacion->modalidad el tema es $capacitacion->tema.";
    
                Mail::to($email)->send(new TestMail($email,$messages));

                return response()->json(['success'=>'Reservación completada!']);
                
        
    }
    

}
