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
	
	<link rel="icon" type="image/png" sizes="32x32" href="{{url('img/favicon_admin.png')}}" />
	

	<!--css-custom-->
	
	<link rel="stylesheet" href="{{url($__env->yieldContent('css-custom')) }}">
	<link rel="stylesheet" href="{{url('css/fellow_styles.css')}}">

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
	<div class="apertus_nav">	
		<header>
			<!--header-->
			@include('layouts.admin.fellow_header')
		</header>
	</div>
	
	<div class="apertus_content">
		@if ($__env->yieldContent('breadcrumb'))
		<div class="breadcrumb">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						@include($__env->yieldContent('breadcrumb'))
					</div>
				</div>
			</div>
		</div>
		@endif
		
		<section>
			<!--content-->
			<div class="container">
			@yield('content')
			</div>
		</section>
		
		<!--footer-->
		@include('layouts.admin.a_footer')
	</div>

	<!--js content -->
	@yield('js-content')	
</body>
</html>
