<ul>
	<li>Estás en:</li>
	<li><a href="{{url('tablero')}}">Tablero</a></li>
	@if ($__env->yieldContent('breadcrumb_type') =="forum list")
	<li>Foros</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view"
	|| $__env->yieldContent('breadcrumb_type') =="forum act list"
	 || $__env->yieldContent('breadcrumb_type') =="forum add message"
	 || $__env->yieldContent('breadcrumb_type') =="forum add question"
	 || $__env->yieldContent('breadcrumb_type') =="forum view question"
	 || $__env->yieldContent('breadcrumb_type') =="forum add answer")
	<li><a href='{{url("tablero/$program->slug/foros")}}'>Foros</a></li>
	@endif
	@if($__env->yieldContent('breadcrumb_type') =="forum view" && ($forum->type === 'activity' || $forum->type === 'general'))
	<li><a href='{{url("tablero/$program->slug/foros/actividades")}}'>Foros de actividades</a></li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum act list")
	<li>Foros de actividades</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum view")
	<li>{{$forum->topic}}</li>
	@endif
	@if ($__env->yieldContent('breadcrumb_type') =="forum add message")
	<li><a href='{{url("tablero/$program->slug/foros/$forum->slug")}}'>{{$forum->topic}}</a></li>
	<li>Agregar mensaje</li>
	@endif

	@if($__env->yieldContent('breadcrumb_type') =="forum add question" && ($forum->type === 'activity' || $forum->type === 'general'))
	<li><a href='{{url("tablero/$program->slug/foros/actividades")}}'>Foros de actividades</a></li>
	@endif

	@if ($__env->yieldContent('breadcrumb_type') =="forum add question")
	<li><a href='{{url("tablero/$program->slug/foros/$forum->slug")}}'>{{$forum->topic}}</a></li>
	<li>Agregar tema o pregunta</li>
	@endif
	@if($__env->yieldContent('breadcrumb_type') =="forum add answer")
		@if($forum->forum->type === 'activity' || $forum->forum->type === 'general')
		<li><a href='{{url("tablero/$program->slug/foros/actividades")}}'>Foros de actividades</a></li>
		@endif
	@endif


	@if ($__env->yieldContent('breadcrumb_type') =="forum add answer")
	<li><a href='{{url("tablero/$program->slug/foros/{$forum->forum->slug}")}}'>{{$forum->forum->topic}}</a></li>
	<li><a href='{{url("tablero/$program->slug/foros/{$forum->forum->slug}/ver-pregunta/$forum->slug")}}'>{{$forum->topic}}</a></li>
	<li>Agregar respuesta</li>
	@endif
	@if($__env->yieldContent('breadcrumb_type') =="forum view question")
		@if($question->forum->type === 'activity' || $question->forum->type === 'general')
		<li><a href='{{url("tablero/$program->slug/foros/actividades")}}'>Foros de actividades</a></li>
		@endif
	@endif


	@if ($__env->yieldContent('breadcrumb_type') =="forum view question")
	<li><a href='{{url("tablero/$program->slug/foros/{$question->forum->slug}")}}'>{{$question->forum->topic}}</a></li>
	<li>{{$question->topic}}</li>
	@endif


</ul>
