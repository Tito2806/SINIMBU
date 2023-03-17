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
                    <h3 class="title-un">GALERIA</h3>
                   
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
                            <li class=""><a href="/galeriaNimbu">TODO</a></li>
                            <li><a href="/galeriaNimbuFiltro/?nombreFiltro=mamifero">MAMIFEROS</a></li>
                            <li><a href="/galeriaNimbuFiltro/?nombreFiltro=aves">AVES</a></li>
                            <li><a href="/galeriaNimbuFiltro/?nombreFiltro=reptiles">REPTILES</a></li>
                        </ul>
                    </nav>
                </div>

                
                <div class="container-cards">
                <div class="cards">
                    @foreach ($galeria as $galerias)
                        <div class="card ">
                            <div class="card__image-holder">
                                <img class="card__image" src="../../../../images/Galeria/{{ $galerias->imagen }}"
                                    alt="wave" />
                            </div>
                            <div class="card-title">
                                <a href="#" class="toggle-info btn">
                                    <span class="left"></span>
                                    <span class="right"></span>
                                </a>
                                <h2>
                                    {{ $galerias->titulo }}

                                </h2>
                            </div>
                            <div class="card-flap flap1">
                                <div class="card-description">
                                    {{ $galerias->descripcion }}
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
                  {!! $galeria->links() !!}
              </div>
            </div>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


                <script src="{{ asset('../../js/galeria.js') }}"></script>


            @stop
