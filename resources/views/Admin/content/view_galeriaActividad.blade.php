<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">

            @if (Auth::check() && Auth::user()->rol == 'Administrador')
                <div class="card-header">
                    <h2>Registro de imágenes de Actividades</h2>
                    <!--boton que llama al modal de crear usuario-->
                    <div class="d-flex flex-row-reverse"><button
                            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder"
                            id="createNewGaleriaActividad"><i class="fas fa-plus"></i>Agregar Imagenes</button></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="tableGaleriaActividad">
                                <thead class="font-weight-bold text-center">
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Categoría</th>
                                        <th>Imagen</th>
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
<div class="modal fade" id="modal-galeriaActividad" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Crear Imagen de Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formGaleriaActividad" name="formGaleriaActividad">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Escriba el titulo">
                        <div class="errors" id="error_Titulo">
                        </div>
                        <br>
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Breve descripción" required></textarea>
                        <div class="errors" id="error_Descripcion">
                        </div>
                        <br>
                        <label for="fecha">Seleccione una fecha</label>
                        <input type="date" name="fecha" class="form-control" id="fecha" placeholder="fecha">
                        <div class="errors" id="error_Fecha">
                        </div>
                        <br>
                        <label for="CategoriaImg">Categoría</label> <br>
                        <select class="form-control" id="categoriaImg" name="categoriaImg">
                            <option value="">Seleccione una categoría</option>
                            <option value="charlas">CHARLAS</option>
                            <option value="capacitaciones">CAPACITACIONES</option>
                            <option value="asesorias">ASESORÍAS</option>
                            <option value="talleres">TALLERES</option>
                            <option value="eventos">EVENTOS</option>
                            <option value="investigacion">INVESTIGACIÓN</option>

                        </select>
                        <div class="errors" id="error_Categoria">
                        </div>
                        <br>
                        <input id="browse" type="file" class="form-control" onchange="previewFiles()" multiple>
                        <div class="errors" id="error_Imagen"></div>
                        <div id="preview"></div>
                        <input type="hidden" name="imagen" class="form-control" id="imagen" value="">
                        <br>
                        <input type="hidden" class="form-control" name="id" id="id" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

@push('scripts')
    <script>
        // Listen for the change event so we can capture the file
        function previewFiles() {
            $("#preview img").remove();
            var preview = document.querySelector('#preview');
            var files = document.querySelector('input[type=file]').files;

            function readAndPreview(file) {
                // Asegurate que `file.name` coincida con el criterio de extensiones
                if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    var reader = new FileReader();
                    reader.addEventListener("load", function() {
                        var image = new Image();
                        image.height = 150;
                        image.width = 150;
                        image.title = file.name;
                        image.src = this.result;
                        document.getElementById("imagen").value = image.src;
                        preview.appendChild(image);
                    }, false);
                    reader.readAsDataURL(file);
                }
            }
            if (files) {
                [].forEach.call(files, readAndPreview);
            }
        };
        $('document').ready(function() {
            // success alert
            function swal_success() {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se completó con éxito!',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
            // error alert
            function swal_error() {
                Swal.fire({
                    position: 'centered',
                    icon: 'error',
                    title: 'Ocurrrió un problema!',
                    showConfirmButton: true,
                })
            }

            function remove_errors() {
                $("#error_Titulo").empty();
                $("#error_Descripcion").empty();
                $("#error_Categoria").empty();
                $("#error_Fecha").empty();
                $("#error_Imagen").empty();
            }

            // table serverside
            var table = $('#tableGaleriaActividad').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('galeriaActividad.index') }}",
                columns: [{
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'categoriaImg',
                        name: 'categoriaImg'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen',
                        "render": function(data) {
                            return '<img src="../../../../images/GaleriaActividad/' + data +
                                '" width="70px">';
                        }
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
            $('#createNewGaleriaActividad').click(function() {
                remove_errors();
                $('#preview > img').remove();
                $('#saveBtn').val("Crear GaleriaActividad");
                $('#id').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formGaleriaActividad').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-galeriaActividad').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editGaleriaActividad', function() {
                remove_errors();
                $("#preview").append("<img id='imagenGaleria'></img>");
                $("#preview img").remove();
                var id_galeriaActividad = $(this).data('id');
                $.get("{{ route('galeriaActividad.index') }}" + '/' + id_galeriaActividad + '/edit',
                    function(data) {
                        $('#saveBtn').val("Editar GaleriaActividad");
                        $('#modal-galeriaActividad').modal('show');
                        $('#id').val(data.id);
                        $('#titulo').val(data.titulo);
                        $('#descripcion').val(data.descripcion);
                        $('#fecha').val(data.fecha);
                        $('#categoriaImg').val(data.categoriaImg);
                        $('#imagen').val(data.imagen);

                    })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                remove_errors();
                $.ajax({
                    data: $('#formGaleriaActividad').serialize(),
                    url: "{{ route('galeriaActividad.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#formGaleriaActividad').trigger("reset");
                        $('#modal-galeriaActividad').modal('hide');
                        swal_success();
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        swal_error();
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            if(key == 'titulo' ){
                                $("#error_Titulo").append("<li class='alert alert-danger'>" +
                                item + "</li>")
                            }
                            if(key == 'descripcion' ){
                                $("#error_Descripcion").append("<li class='alert alert-danger'>" +
                                item + "</li>")
                            }
                            if(key == 'categoriaImg' ){
                                $("#error_Categoria").append("<li class='alert alert-danger'>" +
                                item + "</li>")
                            }
                            if(key == 'fecha' ){
                                $("#error_Fecha").append("<li class='alert alert-danger'>" +
                                item + "</li>")
                            }
                            if(key == 'imagen' ){
                                $("#error_Imagen").append("<li class='alert alert-danger'>" +
                                item + "</li>")
                            }
                        });
                    }
                });

            });
            // Inicializa la funcion de eliminar el usuario
            $('body').on('click', '.deleteGaleriaActividad', function() {
                var id_galeriaActividad = $(this).data("id");

                Swal.fire({
                    title: '?Está seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('galeriaActividad.store') }}" + '/' +
                                id_galeriaActividad,
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
