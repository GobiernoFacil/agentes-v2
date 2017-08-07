<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="survey list")
	<li>Encuestas</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey welcome" || $__env->yieldContent('breadcrumb_type') =="survey session list" || $__env->yieldContent('breadcrumb_type') =="survey welcome facilitator" || $__env->yieldContent('breadcrumb_type') =="survey welcome facilitator name" || $__env->yieldContent('breadcrumb_type') =="survey thanks")
	<li><a href="{{url('tablero/encuestas')}}">Encuestas</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey welcome")
	<li>Encuesta de satisfacción Plataforma Apertus</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey session list")
	<li>Encuestas de facilitadores</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey welcome facilitator")
	<li>Evaluación a Facilitador</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey welcome facilitator name")
	<li>Evaluación a Facilitador: {{$facilitator->name}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="survey thanks")
	<li>Gracias por contestar</li>
	@endif
</ul>