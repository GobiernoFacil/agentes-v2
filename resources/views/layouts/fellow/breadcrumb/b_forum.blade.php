<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forum list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" || $__env->yieldContent('breadcrumb_type') =="forum add message" || $__env->yieldContent('breadcrumb_type') =="forum add question" || $__env->yieldContent('breadcrumb_type') =="forum view question" || $__env->yieldContent('breadcrumb_type') =="forum add answer")
	<li><a href="{{url('tablero/foros')}}">Foros</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view")
	<li>{{$forum->topic}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum add message")
	<li><a href="{{url('tablero/foros/'. $forum->session->slug . '/' .$forum->slug . '/ver')}}">{{$forum->topic}}</a></li>  
	<li>Agregar mensaje</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum add question")
	<li>Agregar tema o pregunta</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum add answer")
	<li>{{$forum->topic}}</li>
	<li>Agregar respuesta</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum view question")
	<li>{{$question->forum->topic}}</li>
	<li>{{$question->topic}}</li>
	@endif
	

</ul>