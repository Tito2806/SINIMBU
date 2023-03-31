@extends('Client.index')
@section('content')
    <link rel="stylesheet" href="{{ asset('../../css/acerca.css') }}">
    <link rel="stylesheet" href="{{ asset('../../css/dev_card.css') }}">
    <div class="slider-wrapper">
      <div class="fr-slider">
        <div class="slide">
            <img data-fixed class="slide-bg" src= "../../../assets/images/slider/Barco.JPG"  alt="slide">
            <h1 data-position="60,260" data-delay="800" data-in="fade" data-out="fade" style="color:rgb(251, 251, 252);">QUIÉNES SOMOS</h1>
            
            
           <!-- <img data-position="100,530" data-delay="600" data-in="fade" data-out="fade" src="../../../assets/images/slider/NINBUBLANCO.png" alt="Enfold">
        <h1 data-position="155,554" data-delay="300" data-in="fade" data-out="fade"> Nimbu </h1>
            <img data-position="236,449" data-delay="1000" data-in="fade" data-out="fade" src="../../../assets/images/slider/e3.png" alt="Enfold">
            <img data-position="322,468" data-delay="1400" data-in="fade" data-out="fade" src="../../../assets/images/slider/e4.png" alt="Enfold">
            <img data-position="384,446" data-delay="1800" data-in="fade" data-out="fade" src="../../../assets/images/slider/e5.png" alt="Enfold">-->
         </div>
       
        </div>
      </div>


    <!-- About Section -->
    <div class="container-about">
         <div class="container">
            <div class="row">
          
            </div>
            <div class="row">
               <div class="col-md-4">
                  <!-- Service item -->
                  <div class="service-box-sb wow fadeInUp">
                     <div class="service-img">
                        <img src="../../../assets/images/slider/Manos.jpg" alt="Enfold">
                     </div>
                     <div class="service-info">
                        <h5>Misión</h5>
                        <div class="desc">
                           Reconocer comunidades o áreas que sufran de algun tipo de necesidad en lo que concierne al recurso hídrico, analizando si es 
                           rentable o provechoso implementar un sistema SCALL para hacer más llevadera la vida cotidiana
                           de los residentes de la comunidad objetivo. Además de esto, pretendemos educar a las comunidades u organizaciones interesadas
                           en temas sobre el aprovechamiento, tratamiento, y conservacion del agua a través de la organización de diferentes capacitaciones u orientaciones                  
                                    <a class="see-more" href="#">

                        <div class="line"></div>
                      </a>
                        </div>
                     </div>
                  </div>
                  <!-- End Service item -->
               </div>
               <div class="col-md-4">
                  <!-- Service item -->
                  <div class="service-box-sb wow fadeInUp" data-wow-delay=".2s">
                     <div class="service-img">
                     <img src="{{asset('/images/logoFinal.jpeg')}}" alt="Enfold">
                     </div>
                     <div class="service-info">
                        <h5>Valores de NIMBÚ</h5>
                        <div class="desc">
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris iaculis sapien sit amet arcu ornare, non commodo ligula consectetur adipiscing elit.
                           <a class="see-more" href="#">
                     
                        <div class="line"></div>
                      </a>
                        </div>
                     </div>
                  </div>
                  <!-- End Service item -->
               </div>
               <div class="col-md-4">
                  <!-- Service item -->
                  <div class="service-box-sb wow fadeInUp" data-wow-delay=".4s">
                     <div class="service-img">
                        <img src="../../../assets/images/slider/Gota.jpg" alt="Enfold">
                     </div>
                     <div class="service-info">
                        <h5>VISIÓN</h5>
                        <div class="desc">
                           Colaborar de manera activa en las diferentes comunidades de la región chorotega con la implementación de sistemas de recolección de agua
                           de lluvia, además de la educación y concientización a las mismas en temas relacionados                           <a class="see-more" href="#"><div class="line"></div></a>
                        </div>
                     </div>
                  </div>
                  <!-- End Service item -->
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
                         <div class="dev_card"> <!-- Here I create a New Div with class name card -->
            <div class="card_img"> <!-- Here I create a New Div for image with class name card_img -->
            <img src="../../../assets/images/Nayeli.jpeg" alt="Meet the New UI Design">
            </div>
            <div class="card_info"> <!-- Here I create a New Div for user info with class name card_info -->
               <h2 class="text-white">Nayeli Carvajal Barrantes</h2>
               <p>Estudiante/UNA Sede Chorotega</p>
               <br><a href="#">Github</a>
               <br><a href="#">Linkedin</a>
            </div>
         </div>
                         </li>
                         <li>
                        <div class="dev_card"> <!-- Here I create a New Div with class name card -->
            <div class="card_img"> <!-- Here I create a New Div for image with class name card_img -->
            <img src="../../../assets/images/Luis Eduardo.jpeg" alt="Meet the New UI Design">
            </div>
            <div class="card_info"> <!-- Here I create a New Div for user info with class name card_info -->
               <h2 class="text-white">Luis Eduardo Gutiérrez Orias</h2>
               <p>Estudiante/UNA Sede Chorotega</p>
               <br><a href="#">Github</a>
               <br><a href="#">Linkedin</a>
            </div>
         </div>
                         </li>
                         <li>
                         <div class="dev_card"> <!-- Here I create a New Div with class name card -->
         <div class="card_img"> <!-- Here I create a New Div for image with class name card_img -->
            <img src="../../../assets/images/Mario.jpeg" alt="user-image">
         </div>
         <div class="card_info"> <!-- Here I create a New Div for user info with class name card_info -->
            <h2 class="text-white">Mario André Salazar Rojas</h2>
            <p>Estudiante/UNA Sede Chorotega</p>
            <br><a href="#">Github</a>
            <br><a href="#">Linkedin</a>
         </div>
      </div>
                         </li>
                              <li>


                              <div class="dev_card"> <!-- Here I create a New Div with class name card -->
         <div class="card_img"> <!-- Here I create a New Div for image with class name card_img -->
            <img src=>
         </div>
         <div class="card_info"> <!-- Here I create a New Div for user info with class name card_info -->
            <h2 class="text-white">Francisco ChongKan Alfaro</h2>
            <p>Estudiante/UNA Sede Chorotega</p>
            <br><a href="#">Github</a>
            <br><a href="#">Linkedin</a>
         </div>
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
