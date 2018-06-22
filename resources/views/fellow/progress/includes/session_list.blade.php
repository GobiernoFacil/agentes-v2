<div class="row">
	<!--nombre de sesión-->
	<div class="col-sm-8">
	    <h5>Sesión {{$session->order}}</h5>
	    <h4>{{$session->name}}</h4>
	</div>
	<!--calificación de sesión-->
	<div class="col-sm-4 right">
		<h5>Estatus de la sesión: </h5>
		<?php $today = date('Y-m-d');?>
		<p>
			@if($session->activity_eval_and_forum()->count() > 0)
				@if($user->complete_session($session->id) && $user->check_progress($session->slug,1))
				<span class="ap_success">Completado</span>
				@else
				<span class="ap_error">Sin completar</span>
				@endif
			@else
			 	<span class="ap_noaplica ap_small">Sin actividades obligatorias</span>
			@endif
			<br>
			<span class="ap_noaplica ap_small">{{ $user->check_progress($session->slug,1) ?  "Con acceso" : "Sin acesso" }}</span>
		</p>
	</div>
	<div class="col-sm-12">
		<div class="divider nm"></div>
	</div>
	@if($session->activity_eval_and_forum()->count() > 0)
    <!--evaluaciones-->
    <div class="col-sm-11 col-sm-offset-1">
        <div class="row">
	        <div class="col-sm-6">
		        <p class="ap_noaplica ap_small ap_nomarginbottom">Actividad obligatoria</p>
	        </div>
	        <div class="col-sm-4">
				<p class="ap_noaplica ap_small ap_nomarginbottom">Tipo de evaluación</p>
			</div>
			<div class="col-sm-2">
				<p class="ap_noaplica ap_small ap_nomarginbottom">Estatus</p>
			</div>
			<div class="col-sm-12">
				<div class="divider nm"></div>
			</div>
			<div class="col-sm-12">
				<?php $r=0?>
				@foreach($session->activity_eval_and_forum() as $activity)
				<?php $r++;?>
				@endforeach
				<?php $f=0;?>
			@foreach($session->activity_eval_and_forum() as $activity)
			    @if($activity->type === 'evaluation')
					@include('fellow.progress.includes.activity_list')
				@elseif($activity->type === 'diagnostic')
					@include('fellow.progress.includes.diagnostic_list')
				@endif
				<?php $f++;?>
			@endforeach
			</div>
			@if($session->forums)
			<div class="col-sm-12">
				<?php $for = $session->all_forum->count();
					$rof = 0?>
				@foreach($session->all_forum as $forum)
				<?php $rof++;?>
				<!--- foros-->
				<div class="row">
					<div class="col-sm-6">
					 <p><strong>{{$forum->topic}}</strong></p>
					</div>
					<div class="col-sm-4">
						<p>Foro</p>
					</div>
					<div class="col-sm-2">
						<p>@if($forum->check_participation($user->id))
							<span class="ap_success">Participaste</span>
							@else
							<span class="ap_error">Sin participar</span>
							@endif
						</p>
					</div>
					@if($for > $rof)
					<div class="col-sm-12">
						<div class="divider nm"></div>
					</div>
					@endif
				</div>
				
				
				@endforeach
			</div>
			@endif
        </div>
    </div>
   
@endif
 <div class="col-sm-12">
	    <div class="divider bg"></div>
    </div>
</div>