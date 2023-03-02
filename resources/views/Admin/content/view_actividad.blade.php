<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            @if (Auth::check() && Auth::user()->rol == 'Administrador')
                <div class="card-header">
                    <h2>Registro de Actividades</h2>
                    <!--boton que llama al modal de crear usuario-->
                    <div class="d-flex flex-row-reverse"><button
                            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewActividad"><i
                                class="fas fa-plus"></i>Agregar Actividad</button></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="tableActividades">
                                <thead class="font-weight-bold text-center">
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Lugar</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
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
<div class="modal fade" id="modal-actividad" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Crear Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formActividad" name="formActividad">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control" id="titulo" required
                            placeholder="Titulo de la actividad">
                        <div class="errors" id="error_Titulo">
                        </div>
                        <br>
                        <textarea class="form-control" required id="descripcion" name="descripcion" placeholder="Breve descripción"></textarea>
                        <div class="errors" id="error_Descripcion">
                        </div>
                        <br>
                        <input type="text" name="lugar" class="form-control" id="lugar" required
                            placeholder="Lugar de la actividad">
                        <div class="errors" id="error_Lugar">
                        </div>
                        <br>
                        <label for="fecha">Fecha de la actividad</label>
                        <input type="date" name="fecha" class="form-control" id="fecha" required
                            placeholder="Fecha de la actividad">
                        <div class="errors" id="error_Fecha">
                        </div>
                        <br>
                        <label for="hora">Hora de la actividad</label>
                        <input type="time" name="hora" class="form-control" id="hora" required
                            placeholder="Hora de la actividad">
                        <div class="errors" id="error_Hora">
                        </div>
                        <br>
                        <label for="imagen">Imagen de la actividad</label>
                        <input id="browse" class="form-control" type="file" onchange="previewFiles()" multiple>
                        <div class="errors" id="error_Imagen">
                        </div>
                        <br>
                        <div id="preview"></div>
                        <input type="hidden" name="imagen" id="imagen" value="">
                        <input type="hidden" name="id" id="id" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold"
                    data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary font-weight-bold" id="saveBtn"></button>
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
                        image.addClass("form-control")
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
                $("#error_Titulo").empty();
                $("#error_Descripcion").empty();
                $("#error_Lugar").empty();
                $("#error_Fecha").empty();
                $("#error_Hora").empty();
                $("#error_Imagen").empty();
            }

            // table serverside
            var table = $('#tableActividades').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('actividades.index') }}",
                columns: [{
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'lugar',
                        name: 'lugar'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'hora',
                        name: 'hora'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen',
                        "render": function(data) {
                            return '<img src="../../../../images/actividades/' + data +
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
            $('#createNewActividad').click(function() {
                remove_errors();
                $('#preview > img').remove();
                $('#saveBtn').text("Guardar");
                $('#id').val('');
                $('#imagen').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formActividad').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-actividad').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editActividades', function() {
                remove_errors();
                $("#preview").append("<img id='imagenActividad'></img>");
                $("#preview img").remove();
                var id_actividad = $(this).data('id');
                $.get("{{ route('actividades.index') }}" + '/' + id_actividad + '/edit', function(data) {
                    $('#saveBtn').text("Actualizar");
                    $('#modal-actividad').modal('show');
                    $('#id').val(data.id);
                    $('#titulo').val(data.titulo);
                    $('#descripcion').val(data.descripcion);
                    $('#lugar').val(data.lugar);
                    $('#fecha').val(data.fecha);
                    $('#hora').val(data.hora);
                    $('#imagen').val(data.imagen);

                })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Guardar');
                remove_errors();
                $.ajax({
                    data: $('#formActividad').serialize(),
                    url: "{{ route('actividades.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#formActividad').trigger("reset");
                        $('#modal-actividad').modal('hide');
                        swal_success();
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        swal_error();
                        $.each(xhr.responseJSON.errors, function(key, item) {
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
                            if (key == 'lugar') {
                                $("#error_Lugar").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'fecha') {
                                $("#error_Fecha").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'hora') {
                                $("#error_Hora").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'imagen') {
                                $("#error_Imagen").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                        });
                    }
                });

            });
            // Inicializa la funcion de eliminar el usuario
            $('body').on('click', '.deleteActividad', function() {
                var id_actividad = $(this).data("id");

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
                            url: "{{ route('actividades.store') }}" + '/' + id_actividad,
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
