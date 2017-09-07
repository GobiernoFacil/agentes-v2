<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="indicator list")
	<li>Lista de indicadores</li>
	@endif

  @if ($__env->yieldContent('breadcrumb_type') =="indicator fellow view")
  <li><a href="{{url('dashboard/indicadores')}}">Lista de indicadores</a></li>
  <li>Encuesta de satisfacción</li>
  @endif
  @if ($__env->yieldContent('breadcrumb_type') =="indicator facilitator list")
  <li><a href="{{url('dashboard/indicadores')}}">Lista de indicadores</a></li>
  <li>Encuesta de facilitadores de Curso 1</li>
  @endif
  @if ($__env->yieldContent('breadcrumb_type') =="indicator facilitator view")
  <li><a href="{{url('dashboard/indicadores')}}">Lista de indicadores</a></li>
  <li><a href="{{url('dashboard/indicadores/facilitadores-modulos')}}">Encuesta de facilitadores de Curso 1</a></li>
  <li>{{$facilitatorData->facilitator->name}}</li>
  @endif
</ul>
