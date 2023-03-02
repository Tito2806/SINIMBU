<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">

            @if (Auth::check() && Auth::user()->rol == 'Administrador')
                <div class="card-header">
                    <h2>Registro de Imágenes de la Fauna</h2>
                    <!--boton que llama al modal de crear usuario-->
                    <div class="d-flex flex-row-reverse"><button
                            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewGaleria"><i
                                class="fas fa-plus"></i>Agregar Imagen</button></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="tableGaleria">
                                <thead class="font-weight-bold text-center">
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th>Título</th>
                                        <th>Descripción</th>
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
<div class="modal fade" id="modal-galeria" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Crear Imagen de Fauna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formGaleria" name="formGaleria">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control" id="titulo" required
                            placeholder="Escriba el nombre">
                        <div class="errors" id="error_Titulo">
                        </div>
                        <br>
                        <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Breve descripción" required></textarea>
                        <div class="errors" id="error_Descripcion">
                        </div>
                        <br>
                        <select class="form-control" id="categoria" name="categoria" required>
                            <option value="">Seleccione una categoría</option>
                            <option value="mamifero">Mamíferos</option>

                            <option value="aves">Aves</option>
                            <!--Funcionalidad para selección de temas predeterminados Lun 19 Sept-->

                            <option value="reptiles">Reptiles</option>
                        </select>
                        <div class="errors" id="error_Categoria">
                        </div>
                        <br>
                        <label for="imagen">imagen</label>
                        <input id="browse" type="file" class="form-control" onchange="previewFiles()" multiple>
                        <div class="errors" id="error_Imagen"></div>
                        <div id="preview"></div>
                        <input type="hidden" name="imagen" class="form-control" id="imagen" value="">
                        <br>
                        <input type="hidden" name="id" id="id" value="">
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
                    title: 'Ocurrió un problema!',
                    showConfirmButton: true,
                })
            }

            function remove_errors() {
                $("#error_Titulo").empty();
                $("#error_Descripcion").empty();
                $("#error_Categoria").empty();
                $("#error_Imagen").empty();
            }

            // table serverside
            var table = $('#tableGaleria').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('galeria.index') }}",
                columns: [{
                        data: 'titulo',
                        name: 'titulo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'categoria',
                        name: 'categoria'
                    },
                    {
                        data: 'imagen',
                        name: 'imagen',
                        "render": function(data) {
                            return '<img src="../../../../images/Galeria/' + data +
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
            $('#createNewGaleria').click(function() {
                remove_errors();
                $('#preview > img').remove();
                $('#saveBtn').text("Guardar");
                $('#id').val('');
                $('#imagen').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formGaleria').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-galeria').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editGaleria', function() {
                remove_errors();

                $("#preview").append("<img id='imagenGaleria'></img>");

                $("#preview img").remove();
                var id_galeria = $(this).data('id');
                $.get("{{ route('galeria.index') }}" + '/' + id_galeria + '/edit', function(data) {
                    $('#saveBtn').text("Actualizar");
                    $('#modal-galeria').modal('show');
                    $('#id').val(data.id);
                    $('#titulo').val(data.titulo);
                    $('#descripcion').val(data.descripcion);
                    $('#categoria').val(data.categoria);
                    $('#imagen').val(data.imagen);

                })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Guardar');

                $.ajax({
                    data: $('#formGaleria').serialize(),
                    url: "{{ route('galeria.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#formGaleria').trigger("reset");
                        $('#modal-galeria').modal('hide');
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
                            if (key == 'categoria') {
                                $("#error_Categoria").append(
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
            $('body').on('click', '.deleteGaleria', function() {
                var id_galeria = $(this).data("id");

                Swal.fire({
                    title: 'Está seguro?',
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
                            url: "{{ route('galeria.store') }}" + '/' + id_galeria,
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
