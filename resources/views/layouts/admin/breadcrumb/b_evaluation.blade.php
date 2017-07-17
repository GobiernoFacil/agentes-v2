<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation list")
	<li>Evaluaciones</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="evaluation activity view")
	<li><a href="{{url('dashboard/evaluacion')}}">Evaluaciones</a></li>
	<li>{{$activity->name}}</li>
	@endif
	
	
</ul>