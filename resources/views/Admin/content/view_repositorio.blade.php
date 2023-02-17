
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">

@if (Auth::check() && Auth::user()->rol == 'Administrador')
<div class="card-header">
    <h2>Tabla Repositorio</h2>
    <!--boton que llama al modal de crear usuario-->
    <div class="d-flex flex-row-reverse"><button
            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewDocumento"><i
                class="fas fa-plus"></i>Agregar Repositorio</button></div>
</div>
<div class="card-body">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table" id="tableRepositorioDocumentos">
                <thead class="font-weight-bold text-center">
                    <tr>
                        {{-- <th>No.</th> --}}
                        <th>Autor</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Tipo Archivo</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="modal-repositorioDocumentos" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Modal Repositorio Archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data" id="formDocumento" name="formDocumento">
                    <div class="form-group">
                        <input type="text" name="autor" class="form-control" id="autor"
                            placeholder="Escriba el autor">
                            <div class="errors" id="error_Autor">
                            </div>
                        <br>
                        <input type="text" name="titulo" class="form-control" id="titulo"
                            placeholder="Escriba el titulo">
                            <div class="errors" id="error_Titulo">
                            </div>
                        <br>
                        <textarea class="form-control" required id="descripcion" name="descripcion" placeholder="Breve descripción"></textarea>
                        <div class="errors" id="error_Descripcion"></div>
                        <br>
                       <!-- <input type="text" name="categoria" class="form-control" id="categoria"
                            placeholder="categoria" id="categoria">-->
                            <label for="TipodeArchivo">Seleccione un tipo</label> <br>
                            <select class="form-control" id="TipodeArchivo" name="TipodeArchivo">
                                <option value="PDF">PDF</option>
                                <option value="DOC">DOC</option>
                              </select>
                              <div class="errors" id="error_Tipo">
                            </div>
                        <br>
                        <input 
                                accept="application/pdf"
                                type="file"
                                id="documento_name"
                                name="documento_name"
                                ref="file"
                                class="form-control"
                        >
                        <br>
                        <input type="hidden" name="documento" id="documento" value="">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" class="form-control" id="fecha"
                        placeholder="Fecha">
                        <div class="errors" id="error_Fecha">
                        </div>
                    <br>
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal">Cerrar</button>
                <button enctype="multipart/form-data"  type="submit" class="btn btn-primary font-weight-bold" id="saveBtn" value=""></button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    @push('scripts')
    <script>
        // Listen for the change event so we can capture the file
        $("#documento_name").change(function(e){
              var file = e.target.files[0];
              fileName = e.target.files[0].name;
              var reader = new FileReader();
              reader.onload = function (e) {
                 $('#documento').val(e.target.result);
              }
              if (file) {
                 reader.readAsDataURL(file);
              }
        });

        

        $('document').ready(function() {
            // success alert
            function swal_success() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se completo con exito!',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
            // error alert
            function swal_error() {
                Swal.fire({
                    position: 'centered',
                    icon: 'error',
                    title: 'Ocurrrio un problema!',
                    showConfirmButton: true,
                })
            }
            function remove_errors() {
                $("#error_Autor").empty();
                $("#error_Titulo").empty();
                $("#error_Descripcion").empty();
                $("#error_Fecha").empty();
                $("#error_Tipo").empty();
            }
            // table serverside
            var table = $('#tableRepositorioDocumentos').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('repositorioDocumento.index') }}",
                columns: [{
                        data: 'autor',
                        name: 'autor'
                    },
                    {
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'TipodeArchivo',
                        name: 'TipodeArchivo'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]   
            });
            // csrf token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // initialize btn add
            $('#createNewDocumento').click(function() {
                $('#saveBtn').text("Guardar");
                $('#id').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formDocumento').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-repositorioDocumentos').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editRepositorio', function() {

                var id_documento = $(this).data('id');
                $.get("{{ route('repositorioDocumento.index') }}" + '/' + id_documento + '/edit', function(data) {
                    $('#saveBtn').text("Actualizar");
                    $('#modal-repositorioDocumentos').modal('show');
                    $('#id').val(data.id);
                    $('#autor').val(data.autor);
                    $('#titulo').val(data.titulo);
                    $('#descripcion').val(data.descripcion);
                    $('#documento').val(data.documento);
                    $('#fecha').val(data.fecha);
                })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $.ajax({
                    data: $('#formDocumento').serialize(),
                    url: "{{ route('repositorioDocumento.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#formDocumento').trigger("reset");
                        $('#modal-repositorioDocumentos').modal('hide');
                        swal_success();
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        swal_error();
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            if (key == 'autor') {
                                $("#error_Autor").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'titulo') {
                                $("#error_Titulo").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'descripcion') {
                                $("#error_Descripcion").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'fecha') {
                                $("#error_Fecha").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'tipo') {
                                $("#error_Tipo").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                        });
                    }
                });

            });
            // Inicializa la funcion de eliminar el usuario
            $('body').on('click', '.deleteArchivo', function() {
                var id_archivo = $(this).data("id");
                Swal.fire({
                    title: 'Esta seguro?',
                    text: "Esta accion no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('repositorioDocumento.store') }}" + '/' + id_archivo,
                            success: function(data) {
                                swal_success();
                                table.draw();
                            },
                            error: function(data) {
                                swal_error();
                            }
                        });
                    }
                })
            });

            // statusing


        });
    </script>
    @push('scripts')
