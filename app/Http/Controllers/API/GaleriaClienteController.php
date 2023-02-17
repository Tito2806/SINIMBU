<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Galeria;
use DataTables;


class GaleriaClienteController extends Controller {

    public function index(Request $request)
    {
        $data = [
            'count_galeria' => Galeria::latest()->count(),
            'title'    => 'Tabla Galeria'
        ];

        if ($request->ajax()) {
            $q_user = Galeria::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('Client.galeria', compact('data'));
    }

}