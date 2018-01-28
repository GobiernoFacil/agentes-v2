@if(!empty($single))
	<?php $notice = $single->notice;?>
@endif	


<div class="row">
	<div class="col-sm-12">
		<h1 class="center">{{$notice->title}}. Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible. </h1>
		<p class="center">Para aplicar a la convocatoria es necesario que cumplas con los siguientes requisitos.<br>
			Recuerda que podrás actualizar la información hasta antes del <strong>{{ date('j  \d\e F \d\e Y',strtotime($notice->end)) }}</strong>.</p> 
			
			 
		<div class="divider"></div>
		<h5 class="center">Tienes:</h5>
	</div>
	<div id="as_coutdown" class="as_coutdown">
	<div class="col-sm-2 col-sm-offset-2">
		<h3 class="center"><span id="days">--</span> <span class="legend">días</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="hours">--</span> <span class="legend">horas</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="minutes">--</span> <span class="legend">minutos</span></h3>
	</div>						    
	<div class="col-sm-2">		    
		<h3 class="center"><span id="seconds">--</span> <span class="legend">segundos</span></h3>
	</div>
	</div>
	<div class="col-sm-12">
		<div class="divider"></div>
	</div>
	<div class="col-sm-12">
		<ul class="nav_aspira">
			<li><a href="{{url('tablero-aspirante')}}" {!! $__env->yieldContent('body_class') == "dashboard" ? 'class="current"' : '' !!}>1  MOTIVOS</a> </li>
			<li><a href="{{url('tablero-aspirante/convocatorias/' .$notice->slug. '/aplicar/agregar-perfil-curricular')}}" {!! $__env->yieldContent('breadcrumb_type') == "notice apply cv" ? 'class="current"' : '' !!}>2 CURRICULUM</a> </li>
			<li><a href="{{url('tablero-aspirante/convocatorias/' .$notice->slug. '/aplicar/agregar-video')}}" {!! $__env->yieldContent('breadcrumb_type') == "notice apply video" ? 'class="current"' : '' !!}>3 VIDEO</a> </li>
			<li><a href="{{url('tablero-aspirante/convocatorias/' .$notice->slug. '/aplicar/agregar-comprobante-domicilio')}}" {!! $__env->yieldContent('breadcrumb_type') == "notice apply comprobante" ? 'class="current"' : '' !!}>4 COMPROBANTE</a></li>
			<li><a href="{{url('tablero-aspirante/convocatorias/' .$notice->slug. '/aplicar')}}" {!! $__env->yieldContent('breadcrumb_type') == "notice apply aviso" ? 'class="current"' : '' !!}>5 AVISO</a></li>
		</ul>
	</div>
</div>

