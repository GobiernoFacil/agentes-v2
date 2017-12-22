<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-aspirante')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="notice index")
	<li>Convocatorias</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="notice view")
	<li><a href="{{url('tablero-aspirante/convocatorias')}}">Convocatorias</a></li>
  <li>{{$notice->title}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="notice files view")
  <li><a href="{{url('tablero-aspirante/convocatorias')}}">Convocatorias</a></li>
  <li><a href='{{url("tablero-aspirante/convocatorias/$notice->slug")}}'>{{$notice->title}}</a></li>
  <li>Ver archivos</li>
	@endif

  @if ($__env->yieldContent('breadcrumb_type') =="notice files add")
  <li><a href="{{url('tablero-aspirante/convocatorias')}}">Convocatorias</a></li>
  <li><a href='{{url("tablero-aspirante/convocatorias/$notice->slug")}}'>{{$notice->title}}</a></li>
  <li><a href='{{url("tablero-aspirante/convocatorias/$notice->slug/ver-archivos")}}'>Ver archivos</a></li>
  <li>Agregar archivos</li>
	@endif

  @if ($__env->yieldContent('breadcrumb_type') =="notice files update")
  <li><a href="{{url('tablero-aspirante/convocatorias')}}">Convocatorias</a></li>
  <li><a href='{{url("tablero-aspirante/convocatorias/$notice->slug")}}'>{{$notice->title}}</a></li>
  <li><a href='{{url("tablero-aspirante/convocatorias/$notice->slug/ver-archivos")}}'>Ver archivos</a></li>
  <li>Actualizar archivos</li>
	@endif



</ul>
