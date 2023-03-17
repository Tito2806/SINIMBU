@extends('Client.index')
@section('content')
    <link rel="stylesheet" href="{{ asset('../../css/capacitacion.css') }}">

    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="card-2">
                <div class="tittle">
                    <h3>RESERVACIÓN DE CAPACITACIÓN</h3>
                </div>
                <form id="formReservacion" name="formReservacion">
                <div class="inputs_positions">
                    <input type="hidden" name="idCapacitacion" id="idCapacitacion" class="form-control" value="{{$capacitacion->id}}">
                    <div class="errors" id="error_idCapacitacion">
                    </div>
                </div>
                <label for="">Información de capacitación</label>
                <div class="info_capacitacion">
                    <label for="">Nombre: {{$capacitacion->nombre}}</label>
                    <label for="">Modalidad: {{$capacitacion->modalidad}}</label>
                    <label for="">Fecha: {{$capacitacion->horario}}</label>
                    <label for="">Fecha: {{$capacitacion->hora}}</label>
                </div>
                <label for="Nombre">Nombre</label>
                <div class="inputs_positions">
                    <input type="text" name="nombre" id="nombre" class="form-control">
                    <div class="errors" id="error_Nombre">
                    </div>
                </div>
                <label for="Apellido1">Primer Apellido</label>
                <div class="inputs_positions">
                    <input type="text" name="apellido1" id="apellido1" class="form-control">
                    <div class="errors" id="error_Apellido1">
                    </div>
                </div>
                <label for="Email">Segundo Apellido</label>
                <div class="inputs_positions">
                    <input type="email" name="apellido2" id="apellido2" class="form-control">
                    <div class="errors" id="error_Apellido2">
                    </div>
                </div>
                <label for="Celular">Celular</label>
                <div class="inputs_positions">
                    <input type="number" name="celular" id="celular" class="form-control">
                    <div class="errors" id="error_Celular">
                    </div>
                </div>
                <label for="Email">Email</label>
                <div class="inputs_positions">
                    <input type="email" name="email" id="email" class="form-control">
                    <div class="errors" id="error_Email">
                    </div>
                </div>
            </form>
                <div class="inputs_positions">
                    <div class="enviar_form">
                    <button class="btn btn-success" id="saveBtn">Reservar</button>
                </div>
                </div>
            </div>
        </div>
    </div>

   

@stop
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

@push('scripts')
<script>

    $('document').ready(function() {
        // success alert
        function swal_success() {
            Swal.fire({
                position: 'centered',
                icon: 'success',
                title: 'Se reservo con exito!',
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
            $("#error_idCapacitacion").empty();
            $("#error_Nombre").empty();
            $("#error_Apellido1").empty();
            $("#error_Apellido2").empty();
            $("#error_Celular").empty();
            $("#error_Email").empty();
        }

        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //Metodo que manda a guardar los datos
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            remove_errors();
            $.ajax({
                data: $('#formReservacion').serialize(),
                url: "{{ route('reservaCliente') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#formReservacion').trigger("reset");
                    swal_success();
                },
                error: function(xhr, status, error) {
                    swal_error();
                    var errorsJSON = jQuery.parseJSON( xhr.responseText );
                    console.log(errorsJSON.errors);
                    $.each(errorsJSON.errors, function(key, item) {
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

    });
</script>
@push('scripts')

