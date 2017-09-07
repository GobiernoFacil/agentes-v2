<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero-facilitador')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="diagnostic list")
	<li>Lista de cuestionarios</li>
	@endif
  @if ($__env->yieldContent('breadcrumb_type') == "diagnostic custom view")
  <li><a href="{{url('tablero-facilitador/diagnostico')}}">Lista de Cuestionarios</a></li>
  <li>{{$questionnaire->title}}</li>
  @endif
</ul>
