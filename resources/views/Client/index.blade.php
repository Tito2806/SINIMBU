<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NIMBÚ</title>
	<link rel="icon" href="{{asset('/images/Water.png')}}">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('../../css/cliente.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	

	   <!-- Google Fonts -->
	   <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,500,600,300,700' rel='stylesheet' type='text/css'>
	   <!-- ionicons Fonts for icons -->
	   <link href="{{asset('../../../assets/css/ionicons.min.css')}}" rel="stylesheet">
	   <!-- bootstrap -->
	   <link href="{{asset('../../../assets/css/bootstrap.css')}}" rel="stylesheet">
	   <!-- Styles CSS-->
	   <link href="{{asset('../../../assets/css/style.css')}}" rel="stylesheet">
	   <!-- Animate CSS-->
	   <link href="{{asset('../../../assets/css/animate.css')}}" rel="stylesheet">
</head>
<body class="hero-anime">

	<header class="site-header">
		<div class="header-inner">
		   <!-- navigation panel -->
		   <div class="container">
			  <div class="row">
				 <div class="header-table col-md-12">
					<div class="brand">
                        <a href="/"><img src="{{asset('/images/logoFinal.jpeg')}}" alt="Enfold"></a>

					   </a>
					</div>
					<nav id="nav-wrap" class="main-nav">
					   <div id="mobnav-btn"> </div>
					   <ul class="sf-menu">
						<li class="current">
							
						 </li>
						  <li>
							 <a href="/actividadesNimbu">Actividades</a>
						  </li>
						  <li>
							 <a href="capacitacionInfo">Capacitaciones</a>
						  </li>
						  <li>
							 <a href="/repositorioNimbu">Repositorio</a>
						  </li>

						  <li>
							 <a href="/galeriaNimbu">Galeria Fauna</a>
						  </li>
                           <li>
                            <a href="/galeriaActividadNimbu">Galeria Actividad</a>
                         </li>
						 <li>
                            <a href="/acerca">Acerca de</a>
                         </li>
						  <li>
							 <a href="/admin">Iniciar Sesión</a>
						  </li>
					   </ul>
					</nav>
				 </div>
			  </div>
			  <!-- End navigation panel -->
		   </div>
		   <!-- End navigation panel -->
		</div>
	 </header>


	<script src="{{asset('../../../assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/superfish.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery.easing.js')}}"></script>
	<script src="{{asset('../../../assets/js/wow.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery.isotope.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery.magnific-popup.js')}}"></script>
	<script src="{{asset('../../../assets/js/jflickrfeed.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery.fitvids.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery.fractionslider.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/jquery-ui-1.10.4.custom.min.js')}}"></script>
	<script src="{{asset('../../../assets/js/SmoothScroll.js')}}"></script>
	<script src="{{asset('../../../assets/js/main.js')}}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<main class="">
		@yield('content')
	</main>
</body>
</html>
