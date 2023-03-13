@extends('Client.index')
@section('content')

    <link rel="stylesheet" href="{{ asset('../../css/galeria.css') }}">
    <!-- <div class="col-md-12">
        <h3 class="title-un"></h3>
        <div class="title-un-icon"><i class="fa ion-ios-flame-outline"></i></div>

       <p class="title-un-des">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, </p>
     </div>
    <h1>
        GALERIA NIMBU
    </h1>-->
    <div class="container-about-portfolio">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-un">GALERIA ACTIVIDAD</h3>
                    
                    <!-- <p class="title-un-des">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, </p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="gallery-portfolio-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="port-filter m-port-filter">
                        <ul>
                            <li class="active"><a href="/galeriaActividadNimbu">TODO</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=virtuales">VIRTUALES</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=charlas">CHARLAS</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=capacitaciones">CAPACITACIONES</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=asesorias">ASESORIAS</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=talleres">TALLERES</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=eventos">EVENTOS</a></li>
                            <li><a href="/galeriaActividadNimbuFiltro/?nombreFiltro=investigacion">INVESTIGACION</a></li>
                            <!-- <li><a href="#" data-filter=".illustration ">Illustration </a></li>
                       <li><a href="#" data-filter=".applications">Applications </a></li>-->
                        </ul>
                    </nav>
                </div>
                <div class="container-cards">
                <div class="cards">
                    @foreach ($galeriaActividadFiltro as $galeriaactividads)
                        <div class="card ">
                            <div class="card__image-holder">
                                <img class="card__image"
                                    src="../../../../images/GaleriaActividad/{{ $galeriaactividads->imagen }}"
                                    alt="wave" />
                            </div>
                            <div class="card-title">
                                <a href="#" class="toggle-info btn">
                                    <span class="left"></span>
                                    <span class="right"></span>
                                </a>
                                <h2>
                                    {{ $galeriaactividads->titulo }}

                                </h2>
                            </div>
                            <div class="card-flap flap1">
                                <div class="card-description">
                                    {{ $galeriaactividads->descripcion }}
                                </div>
                                <div class="card-flap flap2">
                                    <div class="card-actions">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>
                  {!! $galeriaActividadFiltro->links() !!}
              </div>
            </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"
                    integrity="sha512-egJ/Y+22P9NQ9aIyVCh0VCOsfydyn8eNmqBy+y2CnJG+fpRIxXMS6jbWP8tVKp0jp+NO5n8WtMUAnNnGoJKi4w=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

                <script src="{{ asset('../../js/galeria.js') }}"></script>



            @stop
