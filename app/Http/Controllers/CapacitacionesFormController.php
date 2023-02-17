<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capacitacion;
use Mail;

class CapacitacionesFormController extends Controller
{
    //Crear formulario de capacitacion
    public function CreateForm(Request $request) {
        return view('capacitacion');
    }
    //Guardar datos en el formulario de capacitacion
    public function CapacitacionesForm(Request $request){
        //validacion del formulario
        $this->validate($request, [
            'name' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'direccion' => 'required',
            'modalidad' => 'required',
            'horario' => 'required',
            'tema' => 'required'
            //En caso de necesitar más atributos, here you go bbbb
        ]);
        //Guardar datos en base de datos
        Capacitacion::create($request->all());

        \Mail::send('mail', array(
            'name' => $request->get('name'),
            'apellido1' => $request->get('apellido1'),
            'apellido2' => $request->get('apellido2'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'direccion' => $request->get('direccion'),
            'modalidad' => $request->get('modalidad'),
            'horario' => $request->get('horario'),
            'tema' => $request->get('tema')
            //changed this lines to include additional attributes, sadbado 10 sept
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('fchongkan@gmail.com', 'Admin')->subject('Solicitud Capacitacion Nimbu'); //Changed this line to fit my email address, Miercoles 7 Sep
        });
        return back()->with('success', 'Su solicitud ha sido enviada correctamente.');
    }
}