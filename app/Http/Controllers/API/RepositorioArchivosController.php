<?php

namespace App\Http\Controllers\API;

use App\Models\RepositorioArchivo;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\repositorioRequest;

class RepositorioArchivosController extends Controller
{

	protected $repositorioArchivos;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->repositorioArchivos = new RepositorioArchivo();
	}

	public function index(Request $request)
	{
        $data = [
            'count_actividad' => RepositorioArchivo::latest()->count(),
            'menu'       => 'admin.menu.v_menu_admin',
            'content'    => 'admin.content.view_repositorio',
            'title'    => 'Tabla Actividad'
        ];

        if ($request->ajax()) {
            $q_user = RepositorioArchivo::select('*')->orderByDesc('created_at');
            return Datatables::of($q_user)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
						$btn = '<div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-sm btn-icon btn-outline-success btn-circle mr-2 edit editRepositorio"><i class=" fi-rr-edit"></i></div>';
                        $btn = $btn.' <div data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-sm btn-icon btn-outline-danger btn-circle mr-2 deleteArchivo"><i class="fi-rr-trash"></i></div>';
 
                         return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.layouts.v_template',$data);
	}

	public function mostrar(Request $request)
    {
        $filtro = $request->valor;

        $repositorioDocumentos = $this->repositorioDocumentos->latest()->paginate($filtro);

        return $this->sendResponse($repositorioDocumentos, 'Lista de Repositorios!');
    }

	public function list()
	{
		$repositorioDocumentos = $this->repositorioDocumentos->get();
		return $this->sendResponse($repositorioDocumentos, "Lista de Repositorios!");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(repositorioRequest $request)
	{

		if($request->id !== null){
			try {
				$repositorioDocumentos = RepositorioArchivo::FindOrFail($request->id);
				$folderPath = 'documentos/repositorioDocumental/';
	
				$repositorioDocumentosUpdate = $request->all();
				$documento = $repositorioDocumentosUpdate['documento'];
	
				// PDF Flow
				if ($documento):
					// Delete previous document
					unlink($folderPath . $repositorioDocumentos['documento']);
					// Upload new document file
					$uploadedFile = $this->uploadFiles($documento, $repositorioDocumentosUpdate['titulo']);
					$repositorioDocumentosUpdate['documento'] = $uploadedFile['file'];
				else:
					// Assign the same name of model
					$fileNameDocument = $repositorioDocumentosUpdate['titulo'] . time() . '.' . explode('.', $repositorioDocumentos['documento'])[1];
					$repositorioDocumentosUpdate['documento'] = $fileNameDocument;
					rename(
						$folderPath . $repositorioDocumentos['documento'], 
						$folderPath . $fileNameDocument
					);
				endif;
				$repositorioDocumentos->update($repositorioDocumentosUpdate);

			} catch (\Exception $e) {
				return response()->json([
					'message' => $e->getMessage()
				]);
			}
		}else{
			try {
				$repositorioDocumentos = $request->all();
				//dd($repositorioDocumentos);
				if ($repositorioDocumentos['documento']) {
					$uploadedFile = $this->uploadFiles($repositorioDocumentos['documento'], $repositorioDocumentos['titulo']);
					$repositorioDocumentos['documento'] = $uploadedFile['file'];
				}
				if ($repositorioResult = RepositorioArchivo::create($repositorioDocumentos)) :

				endif;
				return $this->sendResponse('Documento no guardado');
			} catch (\Exception $e) {
				return response()->json([
					'message' => $e->getMessage()
				]);
			}
		}

		RepositorioArchivo::updateOrCreate(['id' => $request->id],
		[
		 'autor' => $request->autor,
		 'titulo' => $request->titulo,
		 'descripcion' => $request->descripcion,
		 'fecha' => $request->fecha,
		 'TipodeArchivo' => $request->TipodeArchivo,
		]);   
		return response()->json(['success'=>'Accion exitosa!']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
	 * @return \Illuminate\Http\Response
	 */
	public function show(RepositorioDocumentos $repositorioDocumentos)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
	 * @return \Illuminate\Http\Response
	 */
	public function actualizar(Request $request)
	{

	}

	public function edit(Request $request, $id)
    {
        $repositorioDocumentos = RepositorioArchivo::find($id);

        return response()->json($repositorioDocumentos);

    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\RepositorioDocumentos  $repositorioDocumentos
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{

		$repositorioDocumento = RepositorioArchivo::FindOrFail($id);
		if (file_exists('documentos/repositorioDocumental/' . $repositorioDocumento['documento']) and !empty($repositorioDocumento['documento'])) {
			unlink('documentos/repositorioDocumental/' . $repositorioDocumento['documento']);
		}
		try {
			$repositorioDocumento->delete();
			$bug = 0;
		} catch (\Exception $e) {
			$bug = $e->errorInfo[1];
		}
		if ($bug == 0) {
			echo "success";
		} else {
			echo 'error';
		}
	}

	private function getFileExtension($extension)
	{
		$ext = null;
		if (strpos($extension, 'pdf')) :
			$ext = 'pdf';
		elseif (strpos($extension, 'docx')) :
			$ext = 'docx';
		else :
			$ext = 'pdf';
			$ext = 'docx';
		endif;

		return $ext;
	}

	private function uploadFiles($fileBase64, $fileName) {
		$folderPath = '/documentos/repositorioDocumental/';
		$document_explode = explode(',', $fileBase64);
		$documento = base64_decode($document_explode[1]);
		$fileNameWithExt = $fileName . '-' . time() . '.' . $this->getFileExtension($document_explode[0]);
		
		// Create folder path if not exist
		(!file_exists(public_path() . $folderPath)) 
		? mkdir(public_path() . $folderPath, 0777, true) 
		: null;

		$path = $folderPath . $fileNameWithExt;
		file_put_contents(public_path() . $path, $documento) ? $path : false;

		return [
			'file' => $fileNameWithExt,
			'isSuccess' => true
		];
	}



































}