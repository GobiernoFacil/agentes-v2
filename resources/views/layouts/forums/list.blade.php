<div class="row">
<!-- título-->
	<div class="col-sm-9">
		<h1>{{$forum->topic}}</h1>		
	</div>
	<!-- agregar pregunta-->
	<div class="col-sm-3 center">
		@if($user->type =="admin")
		<a href='{{ url("dashboard/pregunta/foros/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
		@if($user->type =="facilitator")
		<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
		@endif
	</div>
	<!-- descripción-->
	<div class="col-sm-12 forum_list">
		<div class="divider top"></div>
		@if($forum->session)
		<p><span class="type module_session">{{$forum->session->module->title}} / {{$forum->session->name}}</span></p>
		@else
		<p><span class="type state">Estado</span></p>
		@endif
		<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span>{{$forum->created_at->diffForHumans()}}</span></p>
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
						<img src='{{url("img/users/{$conversation->user->image->name}")}}' width="100%">
						@else
						<img src='{{url("img/users/default.png")}}' width="100%">
						@endif
					</div>
					<div class="col-sm-9">
						@if($user->type =="admin")
						<h2><a href='{{ url("dashboard/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif
						@if($user->type =="facilitator")
						<h2><a href='{{ url("tablero-facilitador/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif
						<!--fellow data -->
 						@if($conversation->user->fellowData)
 						<p class="author">Por {{$conversation->user->name." ".$conversation->user->fellowData->surname." ".$conversation->user->fellowData->lastname}} <span>{{$conversation->created_at->diffForHumans()}}</span></p>
 						@elseif($conversation->user->facilitatorData)
 						<!--facilitator data -->
 						<p class="author">Por {{$conversation->user->name." ".$conversation->user->facilitatorData->surname." ".$conversation->user->facilitatorData->lastname}} <span>{{$conversation->created_at->diffForHumans()}}</span></p>
 						@else
 						<!--super user data -->
 						<p class="author">Por {{$conversation->user->name}} <span>{{$conversation->created_at->diffForHumans()}}</span></p>
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
		<a href='{{ url("dashboard/pregunta/foros/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
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
  			<a href='{{ url("dashboard/pregunta/foros/agregar/{$forum->id}") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
  			@endif
  			@if($user->type =="facilitator")
  			<a href='{{ url("tablero-facilitador/foros/pregunta/crear/$forum->id") }}' class="btn gde">Agregar Pregunta o Tema al foro [<strong>+</strong>]</a>
  			@endif
  		</div>
	</div>
</div>
@endif