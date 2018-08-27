<li class="row">
	<!--nombre de sesión-->
	<span class="col-sm-8">
	    <span class="session">Sesión {{$session->order}}</span>
	    <h4>{{$session->name}}</h4>
	</span>
	<!--calificación de sesión-->
	<span class="col-sm-3 right">
		Calificación de la sesión: <br>
		<?php $today = date('Y-m-d');?>
		<strong>
			@if($session->all_activities_for_kardex($user->id)->count() > 0)
				@if($user->session_average($session->id))
					{{!is_null($user->session_average($session->id)->average) ?  number_format(($user->session_average($session->id)->average),2)*10 : 'En revisión'}}
				@else
					Sin calificación
				@endif
			@else
			 No aplica
			@endif
		</strong>
	</span>
	<span class="col-sm-11">
		<div class="divider b"></div>
	</span>
@if($session->all_activities_for_kardex($user->id)->count() > 0)
    <!--evaluaciones-->
    <span class="col-sm-11">
        <ul>
	        <li class="row no-padding">
	        	<span class="col-sm-3 col-sm-offset-6">
					<span class="sub_tab">Tipo de evaluación</span>
				</span>
				<span class="col-sm-3 right">
					<span class="sub_tab">Calificación</span>
				</span>
	        </li>
			@foreach($session->activities as $activity)
			    @if($activity->type === 'evaluation')
						@include('fellow.evaluation.evaluation_includes.eval_list_session_activity')
					@endif
			@endforeach
			@if($session->forums)
            <!--- foros-->
            <li class="row">
	        	<span class="col-sm-6">
	        	 <p><strong>Foros</strong></p>
	        	</span>
	        	<span class="col-sm-3">
	        	 Participaciones
	        	</span>
	        	<span class="col-sm-3 right">
	        	 		{{$user->all_participation_session($session) ? 'Completado' : 'No completado' }}
	        	</span>
	        </li>
			@endif
        </ul>
    </span>
    <span class="col-sm-12"></span>
@endif
</li>
