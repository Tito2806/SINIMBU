@extends('Client.index')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    
    <link rel="stylesheet" href="{{ asset('../../css/capacitacion.css') }}">
    
</head>

<body>
  <div class="slider-wrapper">
    <div class="fr-slider">
      <div class="slide">
          <img data-fixed class="slide-bg" src= "../../../assets/images/slider/CapacitacionAzul.png                                                                                                                                                        " data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" alt="slide">
  
          
         <!-- <img data-position="100,530" data-delay="600" data-in="fade" data-out="fade" src="../../../assets/images/slider/NINBUBLANCO.png" alt="Enfold">
      <h1 data-position="155,554" data-delay="300" data-in="fade" data-out="fade"> Nimbu </h1>
          <img data-position="236,449" data-delay="1000" data-in="fade" data-out="fade" src="../../../assets/images/slider/e3.png" alt="Enfold">
          <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
          <img data-position="384,446" data-delay="1800" data-in="fade" data-out="fade" src="../../../assets/images/slider/e5.png" alt="Enfold">-->
       </div>
      </div>
    </div>
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded" src="../../../assets/images/Nimbu1.jpeg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="border-start border-5 border-primary ps-5 mb-5">
                        <h2 class="display-5 text-uppercase mb-0">Información importante para solicitar una capacitación</h2>
                    </div>
                    <h4 class="text-body mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis harum corrupti minus a eos nesciunt 
                      cumque nihil totam fugiat blanditiis nisi quibusdam neque officia reiciendis eveniet, natus rem iusto sapiente! Diam dolor diam ipsum tempor sit. Clita erat ipsum et lorem stet no labore lorem sit clita duo justo magna dolore</h4>
                    
                    </div>
                </div>
            </div>
        </div>
    

    <div>


    </div>
  
  
  
    
  
  <div class="rowCard">
    @foreach($capacitacion as $capacitaciones)
    <div class="col-md-3">
      <div class="mx-auto" width= 100%>
      <img src="../../../assets/images/slider/Isla1.JPG" class="card-img-top" alt="..." >
        <div class="card-body">
          <h3 class="card-title">{{$capacitaciones->nombre}}</h3>
          <div class="opciones-menu">
          <h5 class="card-text">Modalidad: {{$capacitaciones->modalidad}}</h5>
          <h5 class="card-text">Fecha: {{$capacitaciones->horario}}</h5>
          <h5 class="card-text">Tema: {{$capacitaciones->tema}} </h5>
        </div>
          <footer>
            <a href="{{ url('reservacionNimbu/'.$capacitaciones->id ) }}" class="btn btn-info">  Solicitar </a>
          </footer>
        </div>
      </div>
    </div>
    @endforeach
  </div>
    <!-- About End -->


    <!-- Offer Start -->
   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src=" {{asset('js/main.js')}}"></script>
    
</body>

</html>
@stop