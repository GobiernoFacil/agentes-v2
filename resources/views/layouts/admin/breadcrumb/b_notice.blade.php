<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="notice list")
	<li>Lista de convocatorias</li>
	@endif
  @if ($__env->yieldContent('breadcrumb_type') =="notice add")
  <li><a href="{{url('dashboard/convocatorias')}}">Convocatorias</a></li>
	<li>Agregar de convocatoria</li>
	@endif


</ul>
