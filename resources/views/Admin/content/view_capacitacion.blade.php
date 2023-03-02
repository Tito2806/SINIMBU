<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            @if (Auth::check() && Auth::user()->rol == 'Administrador')
                <div class="card-header">
                    <h2>Registro Capacitaciones</h2>
                    <!--boton que llama al modal de crear usuario-->
                    <div class="d-flex flex-row-reverse"><button
                            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewCapacitacion"><i
                                class="fas fa-plus"></i>Agregar Capacitación</button></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="tableCapacitacion">
                                <thead class="font-weight-bold text-center">
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th>Nombre</th>
                                        <th>Modalidad</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Tema</th>
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
<div class="modal fade" id="modal-capacitacion" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Crear capacitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCapacitacion" name="formCapacitacion">
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" id="nombre" required
                            placeholder="nombre de la capacitación">
                        <div class="errors" id="error_Nombre">
                        </div>
                        <br>
                        <select class="form-control" id="modalidad" name="modalidad" required>
                            <option value="">Seleccione una modalidad</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Presencial">Presencial</option>
                        </select>
                        <div class="errors" id="error_Modalidad">
                        </div>
                        <br>
                        <label for="fecha">Fecha de la capacitación</label>
                        <input type="date" name="horario" class="form-control" id="horario" required
                            placeholder="Horario de la capacitacion">
                        <div class="errors" id="error_Horario">
                        </div>
                        <br>
                        <label for="hora">Hora de la capacitación</label>
                        <input type="time" name="hora" class="form-control" id="hora" required
                            placeholder="Hora de la actividad">
                        <div class="errors" id="error_Hora">
                        </div>
                        <br>
                        <select class="form-control" id="tema" name="tema" required>
                            <option value="">Seleccione un tema</option>
                            <option value="Implementación de SCALLS">Implementación de SCALLS</option>
                            <option value="Tratamiento del agua">Tratamiento del agua</option> <!--Funcionalidad para selección de temas predeterminados Lun 19 Sept-->
                            <option value="Proyecto NIMBU">Proyecto NIMBU</option>
                        </select>
                        <div class="errors" id="error_Tema">
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
                    title: 'Ocurrrio un problema!',
                    showConfirmButton: true,
                })
            }

            function remove_errors() {
                $("#error_Nombre").empty();
                $("#error_Modalidad").empty();
                $("#error_Horario").empty();
                $("#error_Hora").empty();
                $("#error_Tema").empty();
            }

            // table serverside
            var table = $('#tableCapacitacion').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('capacitacion.index') }}",
                columns: [{
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'modalidad',
                        name: 'modalidad'
                    },
                    {
                        data: 'horario',
                        name: 'horario'
                    },
                    {
                        data: 'hora',
                        name: 'hora'
                    },
                    {
                        data: 'tema',
                        name: 'tema'
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
            $('#createNewCapacitacion').click(function() {
                remove_errors();
                $('#saveBtn').text("Guardar");
                $('#id').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formCapacitacion').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-capacitacion').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editCapacitaciones', function() {
                remove_errors();
                var id_capacitacion = $(this).data('id');
                $.get("{{ route('capacitacion.index') }}" + '/' + id_capacitacion + '/edit', function(data) {
                    $('#saveBtn').text("Actualizar");
                    $('#modal-capacitacion').modal('show');
                    $('#id').val(data.id);
                    $('#nombre').val(data.nombre);
                    $('#modalidad').val(data.modalidad);
                    $('#horario').val(data.horario);
                    $('#tema').val(data.tema);
                    $('#hora').val(data.hora);

                })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                remove_errors();
                $.ajax({
                    data: $('#formCapacitacion').serialize(),
                    url: "{{ route('capacitacion.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#formCapacitacion').trigger("reset");
                        $('#modal-capacitacion').modal('hide');
                        swal_success();
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        swal_error();
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            if (key == 'nombre') {
                                $("#error_Nombre").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'modalidad') {
                                $("#error_Modalidad").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'horario') {
                                $("#error_Horario").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'hora') {
                                $("#error_Hora").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'tema') {
                                $("#error_Tema").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                        });
                    }
                });

            });
            // Inicializa la funcion de eliminar el usuario
            $('body').on('click', '.deleteCapacitacion', function() {
                var id_actividad = $(this).data("id");

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
                            url: "{{ route('capacitacion.store') }}" + '/' + id_actividad,
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
