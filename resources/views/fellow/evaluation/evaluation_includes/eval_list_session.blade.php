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
		@if($session->start <= $today)
		<strong>{{$user->session_average($user->id,$session->id) ? $user->session_average($user->id,$session->id)->type !='sin' ? number_format($user->session_average($user->id,$session->id)->average,2) : 'No aplica' : 'Sin calificación'}}</strong>
		@else
		<strong>No aplica</strong>
		@endif
	</span>
	<span class="col-sm-11">
		<div class="divider b"></div>
	</span>

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
            <!--- foros-->
            <li class="row">
	        	<span class="col-sm-6">
	        	 <p><strong>Foros</strong></p>
	        	</span>
	        	<span class="col-sm-3">
	        	 Participaciones
	        	</span>
	        	<span class="col-sm-3 right">
							@if($session->forums)
	        	 	{{$user->forum_participation($user->id,$session->id) > 0  ? $user->forum_participation($user->id,$session->id) : 'Sin participación' }}
						 @else
						 	Sin foros
						 @endif
	        	</span>
	        </li>
        </ul>
    </span>
    <span class="col-sm-12"></span>
</li>
