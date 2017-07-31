@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard fellow')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>

	<div class="col-sm-3">
		<div class="box">
			<ul class="list_dash">
				<li><a class="btn_dash sh active" href="#" data-info="eval"><b class="icon_f i_eval"></b><span>Evaluaciones</span></a></li>
				<li><a class="btn_dash sh" href="#" data-info="act"><b class="icon_f i_act"></b><span>Actividades</span></a></li>
				<li><a class="btn_dash sh" href="#" data-info="forum"><b class="icon_f i_forum"></b>Foros</a></li>
				<li><a class="btn_dash sh" href="#" data-info="avisos"><b class="icon_f i_aviso"></b>Avisos</a></li>
				<li><a class="btn_dash sh" href="#" data-info="files"><b class="icon_f i_files"></b>Tus Archivos</a></li>
				<li><a class="btn_dash sh" href="#" data-info="messages"><b class="icon_f i_messages"></b><span>Conversaciones</span></a></li>
				<li><a class="btn_dash" href="{{url('tablero/calificaciones')}}" data-info="score"><b class="icon_f i_score"></b><span>Calificaciones</span></a></li>
			</ul>
		</div>
	</div>

	<div class="col-sm-9">
		<!--evaluaciones-->
		<div id="eval" class="AP_div">
			<div class="divider b"></div>
			<div class="row">
				<div class="col-sm-8">
					<h2>Próximas evaluaciones </h2>
				</div>
				<div class="col-sm-4 right">
					<a href='{{url("tablero/evaluaciones")}}' class="btn ev xs right">Ver lista de evaluaciones >></a>
				</div>
			</div>
		@if($next_activities->count()>0 || $noForum->count() >0 )
			 @if($next_activities->count()>0)
				@include('fellow.next-activity-dash-view')
			 @endif
			 @if($noForum->count()>0)
					@include('fellow.no-participation-forum-dash-view')
			 @endif
		@else
			<div class="box session_list">
				<div class="row">
					<div class="col-sm-12">
						<p><strong>No hay evaluaciones próximas.</strong></p>
					</div>
				</div>
			</div>
		@endif
		</div>

		<!--actividad-->
		<div id="act" class="row AP_div">
			<div class="col-sm-12">
				<div class="divider b"></div>
				<h2>Tu última actividad</h2>
				@if($user->log->count()>0)
					@if($session)
						@include('fellow.session-dash-view')
					@elseif($activity)
						@include('fellow.activity-dash-view')
					@elseif($module_last)
						@include('fellow.module-dash-view')
					@endif
				@else
				<div class="box session_list">
					<div class="row">
						<div class="col-sm-12">
							<p><strong>Aún no cuentas con actividad, inicia tu curso.</strong></p>
						</div>
						@include('fellow.module-first-dash-view')
					</div>
				</div>
				@endif
			</div>
		</div>

		<!--foros-->
		<div id="forum" class="box forum_list AP_div">
			<h3 class="sa_title">Tu participación en los foros</h3>
			@if($forums->count()>0 || $messagesF->count()>0)
			<ul>
				@foreach($forums as $forum)
				<li class="row">
					<span class="col-sm-2">
						<h3 class="count_messages">{{$forum->messages->count()}}</h3>
					</span>
					<span class="col-sm-10">
						@if($forum->forum)
							@if($forum->forum->session)
							<h2><a href="{{ url('tablero/foros/' .$forum->forum->session->module->slug.'/'.$forum->forum->session->slug) }}">{{$forum->topic}}</a></h2>
							@else
								@if($forum->forum->slug==='foro-general')
								<h2><a href="{{url("tablero/foros/{$forum->forum->slug}")}}">{{$forum->topic}}</a></h2>
								@else
								<h2><a href="{{url("tablero/foros/{$user->fellowData->state}")}}">{{$forum->topic}}</a></h2>
								@endif
							@endif
						@endif
					<p><span>Preguntado {{$forum->created_at->diffForHumans()}}</span></p>
					</span>
				</li>
				@endforeach
				@foreach($messagesF as $mes)
				<li class="row">
					<span class="col-sm-2">
						<h3 class="count_messages">{{$mes->conversation->messages->count()}}</h3>
					</span>
					<span class="col-sm-10">
					@if($mes->conversation->forum->session)
					<h2><a href="{{ url('tablero/foros/' .$mes->conversation->forum->session->module->slug.'/'.$mes->conversation->forum->session->slug) }}">{{$mes->conversation->topic}}</a></h2>
					@else
					<h2><a href="{{url("tablero/foros/{$user->fellowData->state}")}}">{{$mes->conversation->topic}}</a></h2>
					@endif
					<p><span>Creado {{$mes->conversation->forum->created_at->diffForHumans()}}</span></p>
					</span>
				</li>
				@endforeach
			</ul>
			@else
			<p>Aún no cuentas con participación en foros.</p>
			@endif
			<a href="{{ url('tablero/foros') }}" class="btn gde center">Ver los foros</a>
		</div>

		<!-- noticias y avisos-->
		<div id="avisos" class="box news AP_div">
			<h3 class="sa_title">Noticias y avisos</h3>
			<p></p>
			@if($newsEvent->count()>0)
			<ul class="list line">
				@foreach($newsEvent as $article)
				@include('layouts.news.dashboard-news-list')
				@endforeach
			</ul>
			<div class="row">
				<div class="col-sm-12">
					<div class="divider"></div>
				</div>
				<div class="col-sm-8 col-sm-offset-2 center">
					<p><a href="{{url('tablero/noticias')}}" class="btn view gde ">Ver todas las noticas y avisos</a></p>
				</div>
			</div>
			@else
			<p>Aún no existen noticias o avisos.</p>
			@endif
		</div>


		<!---archivos-->
		<div id="files" class="box AP_div">
			<h3 class="sa_title">Tus archivos</h3>
			<a href="{{ url('tablero/perfil/archivos') }}" class="count_link">{{$user->fellowFiles->count()}}</a>
			<a href="{{ url('tablero/perfil/archivos') }}" class="btn gde">Ver todos los archivos</a>
			@if($retro->count()>0)
				<p><h3 class="sa_title">Evaluaciones de archivos sin revisar</h3></p>
				@include('fellow.retro-activity-dash-view')
			@endif
		</div>

		<!--conversaciones-->
		<div id="messages" class="box news AP_div">
			<h3 class="sa_title">Tus Conversaciones</h3>
			<a href="{{ url('tablero/mensajes') }}" class="count_link">{{$user->conversations->count()}}</a>
			<a href="{{ url('tablero/mensajes') }}" class="btn gde">Ver todos los mensajes</a>
			@if($noMessages->count()>0)
				<p><h3 class="sa_title">Mensajes sin contestar</h3></p>
				@include('fellow.message-dash-view')
			@endif
		</div>

	</div>
</div>


@endsection
@section('js-content')
<script src="{{url('js/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>
	$("div.AP_div").each(function(){
    	$(this).hide();
		if($(this).attr('id') == 'eval') {
        	$(this).show();
    	}
	});
	$('a.sh').on( "click", function(e) {
	    e.preventDefault();
	    $('a.sh').removeClass('active');
	    $(this).addClass('active');
	    var id = $(this).attr('data-info');
	    $("div.AP_div").each(function(){
	        $(this).hide();
	        if($(this).attr('id') == id) {
	            $(this).show();
	        }
	    });

	});
</script>
@endsection
