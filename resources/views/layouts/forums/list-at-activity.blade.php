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
		
		<p class="author"><span>Creado {{$forum->created_at->diffForHumans()}}</span></p>
		<div class="divider top"></div>
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
						<img src='{{url("img/users/default.png")}}' width="100%">
					</div>
					<div class="col-sm-9">
						@if($user->type =="admin")
						<h2><a href='{{ url("dashboard/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif
						@if($user->type =="facilitator")
						<h2><a href='{{ url("tablero-facilitador/foros/pregunta/ver/$conversation->id") }}'>{{$conversation->topic}}</a></h2>
						@endif
						<p class="author">Por {{$conversation->user_id}} <span>{{$conversation->created_at->diffForHumans()}}</span></p>
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