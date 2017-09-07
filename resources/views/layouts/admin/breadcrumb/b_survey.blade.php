<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="survey list")
	<li>Lista de encuestas</li>
	@endif

  @if ($__env->yieldContent('breadcrumb_type') =="survey fellow list")
  <li><a href="{{url('dashboard/encuestas')}}">Lista de encuestas</a></li>
  <li>Encuesta de satisfacción</li>
  @endif
  @if ($__env->yieldContent('breadcrumb_type') =="survey fellow view")
  <li><a href="{{url('dashboard/encuestas')}}">Lista de encuestas</a></li>
  <li><a href="{{url('dashboard/encuestas/encuesta-satisfaccion/fellows')}}">Encuesta de satisfacción</a></li>
  <li>{{$fellow->user->name . ' ' . $fellow->user->fellowData->surname}}</li>
  @endif
  @if ($__env->yieldContent('breadcrumb_type') =="survey facilitator list")
  <li><a href="{{url('dashboard/encuestas')}}">Lista de encuestas</a></li>
  <li>Encuesta de facilitadores de Curso 1</li>
  @endif
  @if ($__env->yieldContent('breadcrumb_type') =="survey facilitator view")
  <li><a href="{{url('dashboard/encuestas')}}">Lista de encuestas</a></li>
  <li><a href="{{url('dashboard/encuestas/facilitadores-modulos')}}">Encuesta de facilitadores de Curso 1</a></li>
  <li>{{$facilitatorData->facilitator->name}}</li>
  @endif
</ul>
