<div class="row">
	<!--foro-->
	<div class="col-sm-12 forum_list">
		<h3>{{$question->forum->topic}}</h3>
		@if($question->forum->session)
		<p><span class="type module_session">{{$question->forum->session->module->title}} / {{$question->forum->session->name}}</span></p>
		@else
		<p><span class="type state">Estado</span></p>
		@endif
		<div class="divider b"></div>
	</div>
	<!--avatar-->
	<div class="col-sm-1">
		<img src='{{url("img/users/default.png")}}' width="100%">
	</div>
	<!--pregunta-->
	<div class="col-sm-9 forum_list">
    	<h1>{{$question->topic}} </h1>    
		<p class="author">Por {{$question->user_id}} <span>{{$question->created_at->diffForHumans()}}</span></p>
	</div>
	<!--mensajes-->
	<div class="col-sm-2 forum_list">
		<h3 class="count_messages">{{$question->messages->count()}}</h3>
	</div>
  	<div class="col-sm-12">
	  	<div class="divider b"></div>
  	</div>
  	<div class="col-sm-10 col-sm-offset-1">
	  	<p>{{$question->description}}</p>
  	</div>
</div>


<div class="box">
  @if($question->messages->count()>0 )
  	<div class="row">
  		<div class="col-sm-9">
	  		<h2>{{$question->messages->count() == 1 ? $question->messages->count() . ' respuesta' : $question->messages->count() . ' respuestas' }}</h2>
  		</div>
  		<!--enlace a agregar respuesta-->
	  	<div class="col-sm-3 center">
		  	@if($user->type == "fellow")
	  		<a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
	  		@endif
			@if($user->type == "facilitator")
			<a href='{{ url("tablero-facilitador/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
			@endif
	  	</div>
	  	<div class="col-sm-12">
	  		<div class="divider b"></div>
  		</div>
  	</div>
  	<div class="row">
        <div class="col-sm-8 col-sm-offset-2 forum_list">
    @foreach($question->messages as $message)
      		<div class="row">
	      		<div class="col-sm-1">
		  			<img src='{{url("img/users/default.png")}}' width="100%">
				</div>
				<div class="col-sm-11">
	  				<p>{{$message->message}}</p>
	  				<p class="author">Por {{$message->user_id}} <span>{{$message->created_at->diffForHumans()}}</span></p>
				</div>
				<div class="col-sm-12">
	  			<div class="divider b"></div>
				</div>
      		</div>
    @endforeach
    	</div>
    </div>
    <div class="row">
      	<div class="col-sm-6 col-sm-offset-3 center">
	    	@if($user->type == "fellow")
			<a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
			@endif
			@if($user->type == "facilitator")
			<a href='{{ url("tablero-facilitador/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
			@endif
    	</div>
    </div>
  @else
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h2>No existen respuestas.</h2>
      @if($user->type == "fellow")
      <a href='{{ url("tablero/foros/pregunta/$question->slug/mensajes/agregar") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
	  @endif
      @if($user->type == "facilitator")
	   <a href='{{ url("tablero-facilitador/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
	   @endif
    </div>
  </div>
  @endif
</div>