<ul>
	<li>Estás en:</li>
	<li><a href="{{url('dashboard')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forums list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" || $__env->yieldContent('breadcrumb_type') =="question view" || $__env->yieldContent('breadcrumb_type') =="forum add question" || $__env->yieldContent('breadcrumb_type') =="forum question view" || $__env->yieldContent('breadcrumb_type') =="forum add answer")
	<li><a href="{{url('dashboard/foros')}}">Foros</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum view" )
	<li>{{$forum->topic}}</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum add question")
	<li><a href="{{url('dashboard/foros/programa/' .$forum->program_id . '/ver-foro/' . $forum->id)}}">{{$forum->topic}}</a></li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum add question" )
	<li>Agregar tema o pregunta</li>
	@endif
	@if ( $__env->yieldContent('breadcrumb_type') =="forum add answer" )
	<li><a href="{{url('dashboard/foros/pregunta/ver/' . $forum->id)}}">{{$forum->topic}}</a></li>
	<li>Agregar respuesta</li>
	@endif
	
	@if ($__env->yieldContent('breadcrumb_type') =="forum question view" )
	<li><a href="{{url('dashboard/foros/programa/' .$question->forum->program_id . '/ver-foro/' . $question->forum->id)}}">{{$question->forum->topic}}</a></li>
	<li>{{$question->topic}}</li>
	@endif
</ul>