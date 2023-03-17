<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            @if (Auth::check() && Auth::user()->rol == 'Administrador')
                <div class="card-header">
                    <h2>Registro de capacitaciones reservadas</h2>
                    <!--boton que llama al modal de crear usuario-->
                    <div class="d-flex flex-row-reverse"><button
                            class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewReservacion"><i
                                class="fas fa-plus"></i>Reservar Capacitación</button></div>
                </div>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table" id="tableReservacion">
                                <thead class="font-weight-bold text-center">
                                    <tr>
                                        {{-- <th>No.</th> --}}
                                        <th>Capacitación</th>
                                        <th>Nombre</th>
                                        <th>Primer apellido</th>
                                        <th>Segundo apellido</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
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
<div class="modal fade" id="modal-reservacion" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Crear Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="formReservacion" name="formReservacion">
                    <div class="form-group">
                        <select class="form-control" name="idCapacitacion" id="idCapacitacion">
                            <option value="">Seleccionar capacitación</option>
                            @foreach ($capacitacion as $capacitaciones)
                                <option value="{{ $capacitaciones->id }}">{{ $capacitaciones->nombre }}</option>
                            @endforeach
                        </select>
                        <div class="errors" id="error_idCapacitacion">
                        </div>
                        <br>
                        <input type="text" name="nombre" class="form-control" id="nombre" required
                            placeholder="Escriba el nombre">
                        <div class="errors" id="error_Nombre">
                        </div>
                        <br>
                        <input type="text" name="apellido1" class="form-control" id="apellido1" required
                            placeholder="Escriba el primer apellido">
                        <div class="errors" id="error_Apellido1">
                        </div>
                        <br>
                        <input type="text" name="apellido2" class="form-control" id="apellido2" required
                            placeholder="Escriba el segundo apellido">
                        <div class="errors" id="error_Apellido2">
                        </div>
                        <br>
                        <input type="number" name="celular" class="form-control" id="celular" required
                            placeholder="Escriba el celular">
                        <div class="errors" id="error_Celular">
                        </div>
                        <br>
                        <input type="email" name="email" class="form-control" id="email" required
                            placeholder="Escriba el correo electrónico">
                        <div class="errors" id="error_Email">
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
                    title: 'Ocurrrió un problema!',
                    showConfirmButton: true,
                })
            }

            function remove_errors() {
                $("#error_idCapacitacion").empty();
                $("#error_Nombre").empty();
                $("#error_Apellido1").empty();
                $("#error_Apellido2").empty();
                $("#error_Celular").empty();
                $("#error_Email").empty();
            }

            // table serverside
            var table = $('#tableReservacion').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                processing: false,
                serverSide: true,
                ordering: false,
                dom: 'Bfrtip',
                buttons: ['pdf'],
                ajax: "{{ route('reserva.index') }}",
                columns: [
                    {
                        data: 'idCapacitacion',
                        name: 'idCapacitacion'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'apellido1',
                        name: 'apellido1'
                    },
                    {
                        data: 'apellido2',
                        name: 'apellido2'
                    },
                    {
                        data: 'celular',
                        name: 'celular'
                    },
                    {
                        data: 'email',
                        name: 'email'
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
            $('#createNewReservacion').click(function() {
                remove_errors();
                $('#saveBtn').text("Guardar");
                $('#id').val('');
                //reseteamos el form para que los value de los input esten vacios
                $('#formReservacion').trigger("reset");
                //Este va a mostrar el modal
                $('#modal-reservacion').modal('show');
            });
            // initialize btn edit
            $('body').on('click', '.editReserva', function() {
                remove_errors();
                var id_reservar = $(this).data('id');
                $.get("{{ route('reserva.index') }}" + '/' + id_reservar + '/edit', function(data) {
                    $('#saveBtn').text("Actualizar");
                    $('#modal-reservacion').modal('show');
                    $('#id').val(data.id);
                    $('#nombre').val(data.nombre);
                    $('#apellido1').val(data.apellido1);
                    $('#apellido2').val(data.apellido2);
                    $('#celular').val(data.celular);
                    $('#email').val(data.email);


                })
            });
            //Metodo que manda a guardar los datos
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                remove_errors();
                $.ajax({
                    data: $('#formReservacion').serialize(),
                    url: "{{ route('reserva.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#formReservacion').trigger("reset");
                        $('#modal-reservacion').modal('hide');
                        swal_success();
                        table.draw();

                    },
                    error: function(xhr, status, error) {
                        swal_error();
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            if (key == 'idCapacitacion') {
                                $("#error_idCapacitacion").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'nombre') {
                                $("#error_Nombre").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'apellido1') {
                                $("#error_Apellido1").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'apellido2') {
                                $("#error_Apellido2").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'celular') {
                                $("#error_Celular").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                            if (key == 'email') {
                                $("#error_Email").append(
                                    "<li class='alert alert-danger'>" +
                                    item + "</li>")
                            }
                        });
                    }
                });

            });
            // Inicializa la funcion de eliminar el usuario
            $('body').on('click', '.deleteReserva', function() {
                var id_reservar = $(this).data("id");

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
                            url: "{{ route('reserva.store') }}" + '/' + id_reservar,
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
