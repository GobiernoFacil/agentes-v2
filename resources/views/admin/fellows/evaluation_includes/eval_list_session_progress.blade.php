<li class="row">
	<!--nombre de sesión-->
	<span class="col-sm-8">
	    <span class="session">Sesión {{$session->order}}</span>
	    <h4>{{$session->name}}</h4>
	</span>
	<!--calificación de sesión-->
	<span class="col-sm-3 right">
		Estatus de la sesión: <br>
		<?php $today = date('Y-m-d');?>
		<strong>
			@if($session->activity_eval_and_forum()->count() > 0)
				{{$fellow->complete_session($session->id) && $fellow->check_progress($session->slug,1) ?  "Completado" : "Sin completar" }}
			@else
			 Sin actividades obligatorias
			@endif
		</strong>
		<p>
			<span class="small">{{ $fellow->check_progress($session->slug,1) ?  "Con acceso" : "Sin acesso" }}</span>
		</p>
	</span>
	<span class="col-sm-11">
		<div class="divider b"></div>
	</span>
@if($session->activity_eval_and_forum()->count() > 0)
    <!--evaluaciones-->
    <span class="col-sm-11">
        <ul>
	        <li class="row no-padding">
	        	<span class="col-sm-3 col-sm-offset-6">
					<span class="sub_tab">Tipo de evaluación</span>
				</span>
				<span class="col-sm-3 right">
					<span class="sub_tab">Estatus</span>
				</span>
	        </li>
			@foreach($session->activity_eval_and_forum() as $activity)
			    @if($activity->type === 'evaluation')
						@include('admin.fellows.evaluation_includes.eval_list_session_activity_progress')
					@elseif($activity->type === 'diagnostic')
					  @include('admin.fellows.evaluation_includes.eval_list_session_diagnostic_progress')
					@endif
			@endforeach

			@if($session->forums)
			  @foreach($session->all_forum as $forum)
            <!--- foros-->
            <li class="row">
	        	<span class="col-sm-6">
	        	 <p><strong>{{$forum->topic}}</strong></p>
	        	</span>
	        	<span class="col-sm-3">
	        	 Foro
	        	</span>
	        	<span class="col-sm-3 right">
	        	 		{{$forum->check_participation($fellow->id) ? 'Participó' : 'Sin participar' }}
	        	</span>
	        </li>
				@endforeach
			@endif
        </ul>
    </span>
    <span class="col-sm-12"></span>
@endif
</li>
