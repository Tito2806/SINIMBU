@extends('Client.index')
@section('content')
<link rel="stylesheet" href="{{ asset('../../css/capacitacion.css') }}">


<div class="slider-wrapper">
  <div class="fr-slider">
    <div class="slide">
        <img data-fixed class="slide-bg" src= "../../../assets/images/slider/CapacitacionAzul.png" data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" alt="slide">

        
       <!-- <img data-position="100,530" data-delay="600" data-in="fade" data-out="fade" src="../../../assets/images/slider/NINBUBLANCO.png" alt="Enfold">
    <h1 data-position="155,554" data-delay="300" data-in="fade" data-out="fade"> Nimbu </h1>
        <img data-position="236,449" data-delay="1000" data-in="fade" data-out="fade" src="../../../assets/images/slider/e3.png" alt="Enfold">
        <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
        <img data-position="384,446" data-delay="1800" data-in="fade" data-out="fade" src="../../../assets/images/slider/e5.png" alt="Enfold">-->
     </div>
   

     
    </div>
  </div>
<div class="row">
  @foreach($capacitacion as $capacitaciones)
  <div class="col-md-3">
    <div class="mx-auto" width= 100%>
    <img src="../../../assets/images/slider/Isla1.JPG" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$capacitaciones->nombre}}</h5>
        <div class="opciones-menu">
        <a class="card-text">Modalidad: {{$capacitaciones->modalidad}}</a>
        <a class="card-text">Fecha: {{$capacitaciones->horario}}</a>
        <a class="card-text">Tema: {{$capacitaciones->tema}} </a>
      </div>
        <footer>
          <a href="{{ url('reservacionNimbu/'.$capacitaciones->id ) }}" class="btn btn-info">  Solicitar </a>
        </footer>
      </div>
    </div>
  </div>
  @endforeach
</div>


@stop