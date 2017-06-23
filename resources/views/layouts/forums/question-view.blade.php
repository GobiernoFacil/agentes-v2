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
		@if($question->user->image)
		<img src='{{url("img/users/{$question->user->image->name}")}}' width="100%">
		@else
		<img src='{{url("img/users/default.png")}}' width="100%">
		@endif
	</div>
	<!--pregunta-->
	<div class="col-sm-9 forum_list">
    	<h1>{{$question->topic}} </h1>
    	<p class="author">Por
    	@if($question->user->fellowData)  
    	<!--fellow data -->  
		{{$question->user->name." ".$question->user->fellowData->surname." ".$question->user->fellowData->lastname}} 
		@elseif($question->user->facilitatorData)  
    	<!--facilitator data -->  
		{{$question->user->name." ".$question->user->facilitatorData->surname." ".$question->user->facilitatorData->lastname}} 
		@else
		<!--super user data -->
		{{$question->user->name}}
		@endif	
		<span>{{$question->created_at->diffForHumans()}}</span></p>
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
		  	@if($user->type == "admin")
		  	<a href='{{ url("dashboard/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
      		@endif
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
		      		@if($message->user->image)
			  		<img src='{{url("img/users/{$message->user->image->name}")}}' width="100%">
			  		@else
			  		<img src='{{url("img/users/default.png")}}' width="100%">
			  		@endif
				</div>
				<div class="col-sm-11">
	  				<p>{{$message->message}}</p>
	  				<p class="author">Por 
		  			@if($message->user->fellowData) 	
		  			<!--fellow data -->  
		  			{{$message->user->name." ".$message->user->fellowData->surname." ".$message->user->fellowData->lastname}} 
		  			@elseif($message->user->facilitatorData)  
		  			<!--facilitator data -->  
		  			{{$message->user->name." ".$message->user->facilitatorData->surname." ".$message->user->facilitatorData->lastname}} 
		  			@else
		  			<!--super user data -->
		  			{{$message->user->name}}
		  			@endif	
		  			<span>{{$message->created_at->diffForHumans()}}</span></p>
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
	      	@if($user->type == "admin")
		  	<a href='{{ url("dashboard/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
		  	@endif
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
      @if($user->type == "admin")
      <a href='{{ url("dashboard/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
      @endif
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