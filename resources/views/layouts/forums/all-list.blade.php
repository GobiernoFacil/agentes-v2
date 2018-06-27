@if($forums->count()>0)
<div class="box forum_list">
	<div class="row">
		<div class="col-sm-12 col-xs-12 right">
			<h5>Tipos de Foros:</h5>
			<ul class="type_list">
				<li><b class="general"></b> General</li>
				<li><b class="module_session"></b> Aprendizaje</li>
				<li><b class="state"></b> {{ $user->type == "fellow" ? 'Tu' : '' }} Estado</li>
			</ul>
			<div class="divider b"></div>
		</div>
	</div>
	@foreach ($forums as $forum)
	<div class="row">
		<div class="col-sm-1 col-xs-2">
			<h3 class="count_messages">{{ $forum->forum_conversations->count()}}</h3>
		</div>
		<div class="col-sm-11 col-xs-10">
			@if($user->type == "admin")
				<h2><a href='{{ url("dashboard/foros/programa/$program->id/ver-foro/$forum->id") }}'>{{$forum->topic}}</a></h2>
				<!--<a href ="{{ url('dashboard/foros/eliminar/' . $forum->id) }}"  id ="{{$forum->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a>-->
				@if($forum->type ==='activity')
				<p><span class="type module_session">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
				@elseif($forum->type ==='general')
					<p><span class="type general">General</span></p>
				@elseif($forum->type ==='state')
					<p><span class="type state">Estado</span></p>
				@endif
			@endif
			@if($user->type == "fellow")
				@if($forum->type ==='activity')
				<h2><a href="{{ url('tablero-facilitador/foros/' .$forum->id) }}">{{$forum->topic}}</a></h2>
				<!--<p>{{str_limit($forum->description, $limit = 50, $end = '...')}}</p>-->
				<p><span class="type module_session">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
				@elseif($forum->type ==='general')
				<h2><a href='{{url("tablero-facilitador/foros/{$forum->id}")}}'>{{$forum->topic}}</a></h2>
				<p><span class="type general">General</span></p>
				@elseif($forum->type ==='state')
				<h2><a href='{{url("tablero-facilitador/foros/{$forum->id}")}}'>{{$forum->topic}}</a></h2>
				<p><span class="type state">Estado</span></p>
				@endif
			@endif
			@if($user->type == "facilitator")
				<h2><a href="{{ url('tablero-facilitador/foros/ver-foro/' .$forum->id) }}">{{$forum->topic}}</a></h2>
				@if($forum->type ==='activity')
				<!--<p>{{str_limit($forum->description, $limit = 50, $end = '...')}}</p>-->
				<p><span class="type module_session">{{$forum->session->module->title}} > {{$forum->session->name}}</span></p>
				@elseif($forum->type ==='general')
				<p><span class="type general">General</span></p>
				@elseif($forum->type ==='state')
				<p><span class="type state">Estado</span></p>
				@endif
			@endif
			<p class="author">Creado por <strong>{{!empty($forum->user->institution) ? $forum->user->institution : ''}}</strong> <span><a title="{{ date_format($forum->created_at, 'F j, Y, g:i a') }}">{{$forum->created_at->diffForHumans()}}</a></span></p>
		</div>
		<div class="col-sm-12 col-xs-12">
			<div class="divider"></div>
		</div>
	</div>
	@endforeach
</div>
{{ $forums->links() }}
@else
<div class="row">
  <div class="col-sm-12">
    <p>Sin foros</p>
  </div>
</div>
@endif
