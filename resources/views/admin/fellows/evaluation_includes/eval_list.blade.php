<!--título del módulo-->
<div class="col-sm-9">
	<h4>Módulo {{$n}}</h4>
	<h2 class ="title">{{$module->title}}</h2>
</div>
<!--calificación del módulo-->
<div class="col-sm-3 right">
	<p>Calificación del módulo:
		<span class="score_a block">{{$fellow->module_average($fellow->id,$module->id) ? $fellow->module_average($fellow->id,$module->id)->type !='sin' ? number_format($fellow->module_average($fellow->id,$module->id)->average,2) : 'No aplica'  : 'Sin calificación'}}</span>
		@if(!$module->check_last_activity($module->id))
		<strong>No se toma en consideración</strong>
		@endif
	</p>
</div>
<!--divider-->
<div class="col-sm-12">
	<div class="divider b"></div>
</div>
<!--lista-->
<div class="col-sm-12">
	<ul class="list line">
		@foreach($module->sessions as $session)
			@include('admin.fellows.evaluation_includes.eval_list_session')
        @endforeach
    </ul>
</div>
<!--divider-->
<div class="col-sm-12">
	<div class="divider"></div>
</div>
