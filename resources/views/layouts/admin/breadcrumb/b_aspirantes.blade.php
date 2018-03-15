<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes list")
	<li>Aspirantes por Convocatoria</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes ver" || $__env->yieldContent('breadcrumb_type') =="aspirantes evaluar" ||  $__env->yieldContent('breadcrumb_type') =="aspirantes list non" || $__env->yieldContent('breadcrumb_type') =="aspirantes list verified" || $__env->yieldContent('breadcrumb_type') =='aspirantes evaluar-aplicacion' || $__env->yieldContent('breadcrumb_type') =='aspirantes ver')
	<li><a href="{{url('dashboard/aspirantes')}}">Aspirantes por Convocatoria</a></li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes list verified")
	<li>Verificados</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes list non")
	<li>No verificados</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes ver")
	<li>Ver Aspirante</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirantes evaluar")
	<li>Evaluar Aspirante</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirant notice list")
	<li>Aspirantes - Convocatorias</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="aspirants list")
	<li><a href="{{url('dashboard/aspirantes')}}">Aspirantes - Convocatorias</a></li>
	<li>Lista de aspirantes</li>
	@endif
	
	@if($__env->yieldContent('breadcrumb_type') =='aspirantes evaluar-aplicacion')
	<li><a href="{{ url('dashboard/aspirantes/convocatoria/'.$notice->id . '/aspirantes-con-aplicacion-por-evaluar') }}">Evaluar aspirantes de {{$notice->title}}</a></li>
	<li>{{ $aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname }}</li>
	@endif
</ul>
