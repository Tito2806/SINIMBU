<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\GaleriaActividad;
use DataTables;


class GaleriaActividadClienteController extends Controller {

    public function index(Request $request)
    {
        $data = [
            'count_galeriaActividad' => GaleriaActividad::latest()->count(),
            'title'    => 'Tabla GaleriaActividad'
        ];

        if ($request->ajax()) {
            $q_user = GaleriaActividad::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('Client.galeriaActividad', compact('data'));
    }

}
