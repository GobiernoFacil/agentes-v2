<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="custom view")
  <li>Cuestionario diagnóstico</li>
	<li>{{$questionnaire->title}}</li>
	@endif

</ul>
