@extends('Client.index')
@section('content')

    <link rel="stylesheet" href="{{ asset('../../css/actividades.css') }}">
    <div class="slider-wrapper">
      <div class="fr-slider">
        <div class="slide">
            <img data-fixed class="slide-bg" src= "../../../assets/images/slider/Barco.JPG"  alt="slide">
            <h1 data-position="60,260" data-delay="800" data-in="fade" data-out="fade" style="color:rgb(251, 251, 252);"> ACTIVIDADES NIMBÚ </h1>
            <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
            
           <!-- <img data-position="100,530" data-delay="600" data-in="fade" data-out="fade" src="../../../assets/images/slider/NINBUBLANCO.png" alt="Enfold">
        <h1 data-position="155,554" data-delay="300" data-in="fade" data-out="fade"> Nimbu </h1>
            <img data-position="236,449" data-delay="1000" data-in="fade" data-out="fade" src="../../../assets/images/slider/e3.png" alt="Enfold">
            <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
            <img data-position="384,446" data-delay="1800" data-in="fade" data-out="fade" src="../../../assets/images/slider/e5.png" alt="Enfold">-->
         </div>
       
        </div>
      </div>
     <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem iusto impedit sint animi omnis sit,
       maiores blanditiis consectetur non quos beatae iure, ducimus pariatur fugit, sunt velit et tenetur modi.</p>
     
   
        @foreach($actividad as $actividades)
       
        <div id="card-activity" class="blog-card">
            <div class="meta">
              <div class="photo" style="background-image: url(../../../../images/actividades/{{$actividades->imagen}})"></div>
              <ul class="details">
                <li class="author"><a href="#">{{$actividades->lugar}}</a></li>
                <li class="date">{{$actividades->fecha}}</li>
                <li class="tags">
                
                </li>
              </ul>
            </div>
            <div id="informacion" class="description">
                <h1>{{$actividades->titulo}}</h1>
              <h2>Descripción</h2>
              <span>{{$actividades->descripcion}}</span>
            </div>
          </div>
          @endforeach
</div>
<div class="pagination">
  {!! $actividad->links() !!}
</div>
@stop
