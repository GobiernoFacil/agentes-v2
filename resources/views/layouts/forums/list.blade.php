<div class="row">
<!-- título-->
	<div class="col-sm-9">
		<h1>{{$forum->topic}}</h1>
		@if($user->type==='admin')
		<h2>{{$program->title}}</h2>
		@endif
	</div>
	<!-- agregar pregunta-->
	<div class="col-sm-3 center">
		@if($user->type =="admin")
		<a href='{{ url("dashboard/foros/programa/$program->id/pregunta/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
		@if($user->type =="facilitator")
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
	</div>
	<!-- descripción-->
	<div class="col-sm-12 forum_list">
		<div class="divider top"></div>
		@if($forum->type === 'activity')
		<p><span class="type module_session">{{$forum->session->module->title}} / {{$forum->session->name}}</span></p>
		@elseif($forum->type ==='general')
			<p><span class="type general">General</span></p>
		@elseif($forum->type ==='state')
			<p><span class="type state">Estado</span></p>
		@else
		 	<p><span class="type general">Soporte técnico</span></p>
		@endif
		<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span><a title="{{ date_format($forum->created_at, 'F j, Y, g:i a') }}">{{$forum->created_at->diffForHumans()}}</a></span></p>
		<div class="divider top"></div>
	</div>
	<!-- descripción-->
	<div class="col-sm-10 col-sm-offset-1">
		<h4>Descripción</h4>
		<p>{{$forum->description}}</p>
	</div>
</div>

@if($forums->count()>0)
<div class="box">
	<div class="row">
		<div class="col-sm-10 col-sm-offset-1">
			@foreach ($forums as $conversation)
				<div class="row forum_list">
					<div class="divider b"></div>
					<div class="col-sm-1">
						@if($conversation->user->image)
							@if($conversation->user->fellowData)
							<a href="{{ url('dashboard/fellows/programa/'.$program->id.'/ver-fellow/'. $conversation->user->id) }}"><img src='{{url("img/users/{$conversation->user->image->name}")}}' width="100%"></a>
							@elseif($conversation->user->facilitatorData)
							<a href="{{url('dashboard/facilitadores/ver/' . $conversation->user->id )}}"><img src='{{url("img/users/{$conversation->user->image->name}")}}' width="100%"></a>
							@else
							<img src='{{url("img/users/{$conversation->user->image->name}")}}' width="100%">
							@endif
						@else
							@if($conversation->user->fellowData)
							<a href="{{ url('dashboard/fellows/programa/'.$program->id.'/ver-fellow/'. $conversation->user->id) }}"><img src='{{url("img/users/default.png")}}' width="100%"></a>
							@elseif($conversation->user->facilitatorData)
							<a href="{{url('dashboard/facilitadores/ver/' . $conversation->user->id )}}"><img src='{{url("img/users/default.png")}}' width="100%"></a>
							@else
							<img src='{{url("img/users/default.png")}}' width="100%">
							@endif
						@endif
					</div>
					<div class="col-sm-9">
						@if($user->type =="admin")
						<h2><a href='{{ url("dashboard/foros/programa/$program->id/foro/$forum->id/ver-pregunta/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif
						@if($user->type =="facilitator")
						<h2><a href='{{ url("tablero-facilitador/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif

 						@if($conversation->user->fellowData)
 						<!--fellow data -->
 						<p class="author">Por
	 						@if($user->type =="admin")
	 						<a href="{{ url('dashboard/fellows/programa/'.$program->id.'/ver-fellow/'. $conversation->user->id) }}">{{$conversation->user->name." ".$conversation->user->fellowData->surname." ".$conversation->user->fellowData->lastname}}</a>
	 						@endif
	 						@if($user->type =="facilitator")
	 						{{$conversation->user->name." ".$conversation->user->fellowData->surname." ".$conversation->user->fellowData->lastname}}
	 						@endif
	 						<span><a title="{{ date_format($conversation->created_at, 'F j, Y, g:i a') }}">{{$conversation->created_at->diffForHumans()}}</a></span></p>
 						@elseif($conversation->user->facilitatorData)
 						<!--facilitator data -->
 						<p class="author">Por
	 						@if($user->type =="admin")
	 						<a href="{{url('dashboard/facilitadores/ver/' . $conversation->user->id )}}">{{$conversation->user->name." ".$conversation->user->facilitatorData->surname." ".$conversation->user->facilitatorData->lastname}} </a>
	 						@endif
	 						@if($user->type =="facilitator")
	 						{{$conversation->user->name." ".$conversation->user->facilitatorData->surname." ".$conversation->user->facilitatorData->lastname}}
	 						@endif
	 						<span><a title="{{ date_format($conversation->created_at, 'F j, Y, g:i a') }}">{{$conversation->created_at->diffForHumans()}}</a></span></p>
 						@else
 						<!--super user data -->
 						<p class="author">Por {{$conversation->user->name}} <span><a title="{{ date_format($conversation->created_at, 'F j, Y, g:i a') }}">{{$conversation->created_at->diffForHumans()}}</a></span></p>
 						@endif
					</div>
					<div class="col-sm-2">
						<h3 class="count_messages">{{$conversation->messages->count()}}</h3>
					</div>
				</div>
			@endforeach
			{{ $forums->links() }}
		</div>
		<div class="col-sm-10 col-sm-offset-1">
			<div class="divider b"></div>
		</div>
		<div class="col-sm-8 col-sm-offset-2 center">
		@if($user->type =="admin")
		<a href='{{ url("dashboard/foros/programa/$program->id/pregunta/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
		@if($user->type =="facilitator")
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
		</div>

	</div>
</div>
@else
<div class="box">
	<div class="row center">
		<div class="col-sm-12">
    		<h2>Sin preguntas</h2>
  		</div>
  		<div class="col-sm-6 col-sm-offset-3">
  			@if($user->type =="admin")
  			<a href='{{ url("dashboard/foros/programa/$program->id/pregunta/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
  			@endif
  			@if($user->type =="facilitator")
  			<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
  			@endif
  		</div>
	</div>
</div>
@endif
