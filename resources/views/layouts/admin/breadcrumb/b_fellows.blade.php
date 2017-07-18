<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="fellows list")
	<li>Lista de Fellows</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="fellow ver" || $__env->yieldContent('breadcrumb_type') =="fellow evaluar" || $__env->yieldContent('breadcrumb_type') == "fellow ver calificaciones")
	<li><a href="{{url('dashboard/fellows')}}">Lista de Fellows</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="fellow ver")
	<li>Ver Aspirante</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="fellow evaluar")
	<li>Evaluar Aspirante</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="fellow ver calificaciones")
	<li><a href="{{url('dashboard/fellows/ver/'. $fellow->id)}}">{{$fellow->name.' '.$fellow->fellowData->surname.' '.$fellow->fellowData->lastname}}</a></li>
	<li>Calificaciones</li>
	@endif
</ul>