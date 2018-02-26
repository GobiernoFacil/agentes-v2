<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	@if(!empty($title))
    <?php $title = $title;?>
    @else
    	@if ($__env->yieldContent('title'))
    	<?php $title = $__env->yieldContent('title');?>
    	@else
    	<?php $title = "";?>
    	@endif
    @endif
    <title>{{$title}}</title>

    @if(!empty($description))
     <?php $description = $description;?>
    @else
    	@if ($__env->yieldContent('description'))
    	<?php $description = $__env->yieldContent('description');?>
    	@else
    	<?php $description = "";?>
    	@endif
    @endif
    <meta name="description" content="{{$description}}">


	<meta name="viewport" content="width=device-width, initial-scale=1">
	@if(!empty($canonical))
    <link rel="canonical" href="{{url($canonical)}}">
    @else
    	@if ($__env->yieldContent('canonical'))
    	<?php $canonical = $__env->yieldContent('canonical');?>
    	<link rel="canonical" href="{{url($canonical)}}">
    	@else
    	<link rel="canonical" href="{{url('')}}">
    	@endif
    @endif
	<link rel="icon" type="image/png" sizes="32x32" href="{{url('img/icon_ga.png')}}" />
	<!-- FB-->
	<meta property="og:title" content="{{$title}}"/>
	<meta property="og:site_name" content="Gobierno Abierto"/>
	<meta property="og:description" content="{{ $description}}"/>

	@if(!empty($og_image))
		<?php $og_image = $og_image;?>
	@else
		@if ($__env->yieldContent('og_image'))
    	<?php $og_image = $__env->yieldContent('og_image');?>
    	@else
    	<?php $og_image = 'og_image.png';?>
    	@endif
	@endif

	<meta property="og:image" content='{{url("img/{$og_image}")}}'/>
	<!--css-custom-->

	<link rel="stylesheet" href="{{url($__env->yieldContent('css-custom')) }}">
	<link rel="stylesheet" href="{{url('css/styles.css')}}">

	<script src="{{url('js/modernizr.js')}}"></script> <!-- Modernizr -->
<!--
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
.oPYo.        8       o                              ooooo     .o         o 8
8    8        8                                      8                      8
8      .oPYo. 8oPYo. o8 .oPYo. oPYo. odYo. .oPYo.   o8oo   .oPYo. .oPYo. o8 8
8   oo 8    8 8    8  8 8oooo8 8  `' 8' `8 8    8    8     .oooo8 8    '  8 8
8    8 8    8 8    8  8 8.     8     8   8 8    8    8     8    8 8    .  8 8
`YooP8 `YooP' `YooP'  8 `Yooo' 8     8   8 `YooP'    8     `YooP8 `YooP'  8 8
:....8 :.....::.....::..:.....:..::::..::..:.....::::..:::::.....::.....::....
:::::8 :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::..:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
-->
@if(!empty($body_class))
	<?php $body_class = $body_class;?>
@else
	@if ($__env->yieldContent('body_class'))
	<?php $body_class = $__env->yieldContent('body_class');?>
	@endif
@endif
</head>
<body class="{{empty($body_class) ? "" : $body_class}}">

	<div class="login_c">
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-8 right">
					<a href="{{url('login')}}">Ingresar a la Plataforma</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<header>
		<!--header-->
		@include('layouts.frontend.header')
		</header>

	</div>
	@if ($__env->yieldContent('breadcrumb'))
	<div class="container">
			<div class="breadcrumb">
			<div class="row">
		<div class="col-sm-12">
		@include($__env->yieldContent('breadcrumb'))
		</div>
		</div>
		</div>
	</div>
	@endif
	<main class="main-content">
		
		@if(!empty($body_class))
			<?php $body_class = $body_class;?>
			@if($body_class == "home")
				<div class="bgdimg">
					<figure>
						<img src="{{url('img/home_apertus_2018.jpeg')}}" alt="Gobierno Abierto desde lo local para el desarrollo sostenible">
					</figure>
					<div class="container">
						<div class="cta">
							<div class="row">
								<div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
									<h1>Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto</strong> y Desarrollo Sostenible</h1>
									<a href="{{url('convocatoria')}}" class="btn blue i_convoca_w"><strong>Convocatoria 2018</strong><br> <span>abierta del 6 de febrero al 25 de marzo</span></a>
									<a href="{{url('programa-gobierno-abierto/2017/testimonios')}}" class="btn">Testimonios del Programa de Formación 2017</a>
								</div>
							</div>
					</div>
					</div>
				</div>
			@endif
		@else
			@if ($__env->yieldContent('body_class'))
			<?php $body_class = $__env->yieldContent('body_class');?>
				<div class="bgdimg">
					<figure>
						<img src="{{url('img/home_apertus_2018.jpeg')}}" alt="Gobierno Abierto desde lo local para el desarrollo sostenible">
					</figure>
					<div class="container">
						<div class="cta">
							<div class="row">
								<div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
									<h1>Programa de Formación de <strong>Agentes Locales de Cambio</strong> en <strong>Gobierno Abierto</strong> y Desarrollo Sostenible</h1>
									<a href="{{url('convocatoria')}}" class="btn blue i_convoca_w">Convocatoria 2018</a>
								</div>
							</div>
					</div>
					</div>
				</div>
			@endif
		@endif
		
		
		
		<!--content-->
		<div class="container">
		@yield('content')
		</div>

		<!--footer-->
		@include('layouts.frontend.footer')

		<!--js content -->
		@yield('js-content')
	</main>
</body>
</html>
