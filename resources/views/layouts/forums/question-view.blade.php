<div class="row">
	<!--foro-->
	<div class="col-sm-12 forum_list">
		<h3>{{$question->forum->topic}}</h3>
		@if($question->forum->type ==='activity')
		<p><span class="type module_session">{{$question->forum->session->module->title}} / {{$question->forum->session->name}}</span></p>
		@elseif($question->forum->type ==='general')
			<p><span class="type general">General</span></p>
		@elseif($question->forum->type ==='state')
			<p><span class="type state">Estado</span></p>
		@endif
		<div class="divider b"></div>
	</div>
	<!--avatar-->
	<div class="col-sm-2">
		@if($question->user->image)
			@if($question->user->fellowData)
			<!--fellow data -->
				@if($user->type =="admin")
				<!--si dashboard admin-->
	 				<a href='{{url("dashboard/fellows/programa/$program->id/ver-fellow/{$question->user->id}") }}'>
	 			@endif
	 			@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 				<a>
	 			@endif
			@elseif($question->user->facilitatorData)
			<!--facilitator data -->
				@if($user->type =="admin")
				<!--si dashboard admin-->
	 				<a href="{{url('dashboard/facilitadores/ver/' . $question->user->id )}}">
	 			@endif
	 			@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 				<a>
	 			@endif
			@else
			<a>
			@endif
			<figure class="ap_figure xs">
			<img src='{{url("img/users/{$question->user->image->name}")}}' width="100%"> </figure>
			</a>
		@else
			@if($question->user->fellowData)
				@if($user->type =="admin")
				<!--si dashboard admin-->
	 				<a href='{{url("dashboard/fellows/programa/$program->id/ver-fellow/{$question->user->id}") }}'>
	 			@endif
	 			@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 				<a>
	 			@endif
			@elseif($question->user->facilitatorData)
			<!--facilitator data -->
				@if($user->type =="admin")
				<!--si dashboard admin-->
	 				<a href="{{url('dashboard/facilitadores/ver/' . $question->user->id )}}">
	 			@endif
	 			@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 				<a>
	 			@endif
			@else
			<a>
			@endif
			<figure class="ap_figure xs">
			<img src='{{url("img/users/default.png")}}' width="100%">
			</figure>
			</a>
		@endif
	</div>
	<!--pregunta-->
	<div class="col-sm-8 forum_list">
    	<h1>{{$question->topic}} </h1>
    	<p class="author">Por
    	@if($question->user->fellowData)
    	<!--fellow data -->
    		@if($user->type =="admin")
		  		<!--si dashboard admin-->
	 			<a href='{{url("dashboard/fellows/programa/$program->id/ver-fellow/{$question->user->id}") }}'>{{$question->user->name." ".$question->user->fellowData->surname." ".$question->user->fellowData->lastname}}</a>
	 		@endif
	 		@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 			{{$question->user->name." ".$question->user->fellowData->surname." ".$question->user->fellowData->lastname}}
	 		@endif
		@elseif($question->user->facilitatorData)
    	<!--facilitator data -->
    		@if($user->type =="admin")
		  		<!--si dashboard admin-->
	 			<a href="{{url('dashboard/facilitadores/ver/' . $question->user->id )}}">{{$question->user->name." ".$question->user->facilitatorData->surname." ".$question->user->facilitatorData->lastname}}</a>
	 		@endif
		  	@if($user->type =="facilitator")
	 			<!--si dashboard facilitador-->
	 			{{$question->user->name." ".$question->user->facilitatorData->surname." ".$question->user->facilitatorData->lastname}}
	 		@endif

		@else
		<!--super user data -->
		{{$question->user->name}}
		@endif
		<span><a title="{{ date_format($question->created_at, 'F j, Y, g:i a') }}">{{$question->created_at->diffForHumans()}}</a></span></p>
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
		  	<a href='{{ url("dashboard/foros/programa/$program->id/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
      		@endif
		  	@if($user->type == "fellow")
	  		<a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
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
        <div class="col-sm-10 col-sm-offset-1 forum_list">
    @foreach($question->messages as $message)
      		<div class="row">
	      		<div class="col-sm-3">
		      		@if($message->user->image)
						@if($message->user->fellowData)
						<!--fellow data -->
							@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 							<a href='{{url("dashboard/fellows/programa/$program->id/ver-fellow/{$message->user->id}") }}'>
	 						@endif
	 						@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 							<a>
	 						@endif
						@elseif($message->user->facilitatorData)
						<!--facilitator data -->
							@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 							<a href='{{url("dashboard/facilitadores/ver/{$message->user->id}") }}'>
	 						@endif
	 						@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 							<a>
	 						@endif
						@else
						<a>
						@endif
						<figure class="ap_figure">
						<img src='{{url("img/users/{$message->user->image->name}")}}' width="100%">
						</figure>
						</a>
					@else
						@if($message->user->fellowData)
							@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 							<a href="{{url('dashboard/facilitadores/ver/' . $message->user->id )}}">
	 						@endif
	 						@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 							<a>
	 						@endif
						@elseif($message->user->facilitatorData)
						<!--facilitator data -->
							@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 							<a href="{{url('dashboard/facilitadores/ver/' . $message->user->id )}}">
	 						@endif
	 						@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 							<a>
	 						@endif
						@else
						<a>
						@endif
						<figure class="ap_figure">
						<img src='{{url("img/users/default.png")}}' width="100%">
						</figure>
						</a>
					@endif

				</div>
				<div class="col-sm-9">
	  				<p class="f-message">{{$message->message}}</p>
	  				<p class="author">Por
		  			@if($message->user->fellowData)
		  			<!--fellow data -->
		  				@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 						<a href='{{url("dashboard/fellows/programa/$program->id/ver-fellow/{$message->user->id}") }}'>{{$message->user->name." ".$message->user->fellowData->surname." ".$message->user->fellowData->lastname}}</a>
	 					@endif
	 					@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 						{{$message->user->name." ".$message->user->fellowData->surname." ".$message->user->fellowData->lastname}}
	 					@endif
		  			@elseif($message->user->facilitatorData)
		  			<!--facilitator data -->
		  				@if($user->type =="admin")
		  					<!--si dashboard admin-->
	 						<a href="{{url('dashboard/facilitadores/ver/' . $message->user->id )}}">{{$message->user->name." ".$message->user->facilitatorData->surname." ".$message->user->facilitatorData->lastname}}</a>
	 					@endif
		  				@if($user->type =="facilitator")
	 						<!--si dashboard facilitador-->
	 						{{$message->user->name." ".$message->user->facilitatorData->surname." ".$message->user->facilitatorData->lastname}}
	 					@endif
		  			@else
		  			<!--super user data -->
		  			{{$message->user->name}}
		  			@endif
		  			<span><a title="{{ date_format($message->created_at, 'F j, Y, g:i a') }}">{{$message->created_at->diffForHumans()}}</a></span></p>
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
		  	<a href='{{ url("dashboard/foros/programa/$program->id/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
		  	@endif
	    	@if($user->type == "fellow")
			<a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}'class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
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
      <a href='{{ url("dashboard/foros/programa/$program->id/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
      @endif
      @if($user->type == "fellow")
      <a href='{{ url("tablero/$program->slug/foros/pregunta/$question->slug/agregar-mensaje") }}' class="btn gde download">Agregar Respuesta [<strong>+</strong>]</a>
	  @endif
      @if($user->type == "facilitator")
	   <a href='{{ url("tablero-facilitador/foros/pregunta/mensajes/agregar/$question->id") }}' class="btn gde">Agregar Respuesta [<strong>+</strong>]</a>
	   @endif
    </div>
  </div>
  @endif
</div>
