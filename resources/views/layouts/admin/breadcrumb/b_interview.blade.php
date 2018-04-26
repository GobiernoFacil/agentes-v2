<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>

  @if ($__env->yieldContent('breadcrumb_type') =="aspirants interview view"
       || $__env->yieldContent('breadcrumb_type') =="aspirants interview list"
       ||  $__env->yieldContent('breadcrumb_type') =="aspirants interview add"
       || $__env->yieldContent('breadcrumb_type') =="aspirants interview all"
       || $__env->yieldContent('breadcrumb_type') =="aspirants interview update"
       || $__env->yieldContent('breadcrumb_type') =="aspirants interviewed")
	<li><a href="{{url('dashboard/aspirantes')}}">Aspirantes por Convocatoria</a></li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirants interview list")
	<li>Tus aspirantes por entrevistar</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirants interview view")
  <li><a href="{{url('dashboard/aspirantes/convocatoria/'.$notice->id.'/entrevistas')}}">Tus aspirantes por entrevistar</a></li>
	<li>Ver entrevista</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirants interview add")
  <li><a href="{{url('dashboard/aspirantes/convocatoria/'.$notice->id.'/entrevistas')}}">Tus aspirantes por entrevistar</a></li>
	<li>Agregar entrevista</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirants interview all")
	<li>Todos los aspirantes entrevistados</li>
	@endif

  @if ($__env->yieldContent('breadcrumb_type') =="aspirants interview update")
  <li><a href="{{url('dashboard/aspirantes/convocatoria/'.$notice->id.'/entrevistas')}}">Tus aspirantes por entrevistar</a></li>
	<li>Actualizar entrevista</li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="aspirants interviewed")
	<li>Tus aspirantes entrevistados</li>
	@endif

</ul>
