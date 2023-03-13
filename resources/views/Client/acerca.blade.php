@extends('Client.index')
@section('content')
    <link rel="stylesheet" href="{{ asset('../../css/acerca.css') }}">

    <div class="slider-wrapper">
      <div class="fr-slider">
        <div class="slide">
            <img data-fixed class="slide-bg" src= "../../../assets/images/slider/Barco.JPG"  alt="slide">
            <h1 data-position="60,260" data-delay="800" data-in="fade" data-out="fade" style="color:rgb(251, 251, 252);"> DESARROLLADORES </h1>
            <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/s2e1.png" alt="Enfold">
            
           <!-- <img data-position="100,530" data-delay="600" data-in="fade" data-out="fade" src="../../../assets/images/slider/NINBUBLANCO.png" alt="Enfold">
        <h1 data-position="155,554" data-delay="300" data-in="fade" data-out="fade"> Nimbu </h1>
            <img data-position="236,449" data-delay="1000" data-in="fade" data-out="fade" src="../../../assets/images/slider/e3.png" alt="Enfold">
            <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
            <img data-position="384,446" data-delay="1800" data-in="fade" data-out="fade" src="../../../assets/images/slider/e5.png" alt="Enfold">-->
         </div>
       
        </div>
      </div>


    <div class="container-about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-un">MISION, VISION Y VALORES</h3>
                    <div class="title-un-icon"><i class="fa ion-ios-time-outline"></i></div>
                    <div class="container-1">
                    <div class="card">
                        <h1>Vision</h1>
                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero voluptas illo voluptatibus assumenda
                            inventore dolor laboriosam iure, quibusdam dolore odit. Labore eum dolorum laboriosam iusto eaque,
                            voluptates doloribus exercitationem veniam.</span>
                    </div>
                    <div class="card">
                        <h1>Mision</h1>
                        <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ducimus corporis assumenda rerum facere
                            asperiores soluta non aperiam consequatur qui, praesentium harum et necessitatibus voluptas culpa id
                            quidem, quo accusantium labore!</span>
                    </div>
                    <div class="card">
                        <h1>Valores</h1>
                        <ul>
                            <li>Respeto</li>
                            <li>Trabajo</li>
                            <li>Amigable</li>
                            <li>Colaboradores</li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="container-2">
            <div class="container">
                <div class="row">
                   <div class="col-md-12">
                      <h3 class="title-un">ENCARGADOS DEL PROYECTO</h3>
                      <div class="title-un-icon"><i class="fa ion-ios-time-outline"></i></div>
                     <!-- <p class="title-un-des">Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, </p>-->
                      <ul class="blog-posts-g">
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/FOTO ADOLFO.jpeg" alt="Meet the New UI Design">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5><a href="#"> Adolfo Salinas Acosta </a></h5>
                               <div class="post-info"><span> Profesor</span>/<span><a href="#">UNA SEDE NICOYA</a></span></div>
                               <p>
                                  Dow wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse iriure molestie...
                               </p>
                            </div>
                         </li>
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/FOTO RONALD.jpeg" alt="A LOOK INSIDE THE Workspace">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5> <a href="#"> Ronald Sánchez Brenes </a></h5>
                               <div class="post-info"><span> Profesor</span>/<span><a href="#"> UNA SEDE LIBERIA</a></span></div>
                               <p>
                                  Dow wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse iriure molestie...
                               </p>
                            </div>
                         </li>
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/FOTO WILLLIAM.jpeg" alt="Inspiration of UX design">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5><a href="#"> William Gómez Solís </a></h5>
                               <div class="post-info"><span>Profesor</span>/<span><a href="#">UNA SEDE NICOYA</a></span></div>
                               <p>
                                  Dow wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse iriure molestie...
                               </p>
                            </div>
                         </li>
                      </ul>
                      <div class="align-center"> <!--<a class="button" href="#">See More Posts</a>--> </div>
                   </div>
                </div>
             </div>
        </div>
        <div class="container-3">
            <div class="container">
                <div class="row">
                   <div class="col-md-12">
                      <h3 class="title-un">DESARROLLADORES DEL PROYECTO</h3>
                      <div class="title-un-icon"><i class="fa ion-ios-time-outline"></i></div>
                    <div class="content-profile">
                        
                     <ul class="blog-posts-g">
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/Nayeli.jpeg" alt="Meet the New UI Design">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5><a href="#"> Nayeli </a></h5>
                               <div class="post-info"><span>ESTUDIANTE</span>/<span><a href="#">UNA SEDE NICOYA</a></span></div>
                            </div>
                         </li>
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/Luis Eduardo.jpeg" alt="Meet the New UI Design">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5><a href="#"> Luis Eduardo </a></h5>
                               <div class="post-info"><span>ESTUDIANTE</span>/<span><a href="#">UNA SEDE NICOYA</a></span></div>
                            </div>
                         </li>
                         <li>
                            <div class="post-img">
                               <a href="#">
                                  <img src="../../../assets/images/Mario.jpeg" alt="Meet the New UI Design">
                               </a>
                            </div>
                            <div class="post-content">
                               <h5><a href="#"> Mario </a></h5>
                               <div class="post-info"><span>ESTUDIANTE</span>/<span><a href="#">UNA SEDE NICOYA</a></span></div>
                            </div>
                         </li>
                      </ul>
                    </div> 
                    
                   </div>
                </div>
             </div>
        </div>
    </div>

@stop
