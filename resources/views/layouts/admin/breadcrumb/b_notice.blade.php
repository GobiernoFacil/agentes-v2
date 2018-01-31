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
	@if ($__env->yieldContent('breadcrumb_type') =="notice update")
  <li><a href="{{url('dashboard/convocatorias')}}">Convocatorias</a></li>
	<li><a href='{{url("dashboard/convocatorias/ver/{$notice->id}")}}'>{{str_limit($notice->title,50)}}</a></li>
	<li>Actualizar convocatoria</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="notice add-files")
	<li><a href="{{url('dashboard/convocatorias')}}">Convocatorias</a></li>
	<li><a href='{{url("dashboard/convocatorias/ver/$notice->id")}}'>{{str_limit($notice->title,50)}}</a></li>
	<li>Agregar archivos a convocatoria</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="notice view")
	<li><a href="{{url('dashboard/convocatorias')}}">Convocatorias</a></li>
	<li>Convocatoria {{str_limit($notice->title,50)}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="notice update-file")
	<li><a href="{{url('dashboard/convocatorias')}}">Convocatorias</a></li>
	<li><a href='{{url("dashboard/convocatorias/ver/{$file->notice->id}")}}'>{{str_limit($file->notice->title,50)}}</a></li>
	<li>Actualizar archivo</li>
	@endif
</ul>
