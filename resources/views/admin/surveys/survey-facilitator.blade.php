@extends('layouts.admin.a_master')
@section('title', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name)
@section('description', 'Resultados de encuesta por sesión de ' . $facilitatorData->facilitator->name.' sesión '.$facilitatorData->session->name)
@section('body_class', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta de <strong>{{$facilitatorData->facilitator->name}}</strong></h1>
    <h2>Sesión <strong>{{$facilitatorData->session->name}}</strong></h2>
		<div class="divider top"></div>
	</div>
	<!--info fellow-->
	<div class="col-sm-1 center">
		@if($facilitatorData->facilitator->image)
		<img src='{{url("img/users/{$facilitatorData->facilitator->image->name}")}}' width="1000">
		@else
		<img src='{{url("img/users/default.png")}}' height="40px">
		@endif
	</div>
	<div class="col-sm-3">
		<p>{{$facilitatorData->facilitator->facilitatorData->institution}}</p>
	</div>
</div>
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
				<ol class="list line">
					<li class="row">
						<span class="col-sm-9">
						<h3>La claridad de exposición del facilitador fue</h3>
						</span>
            <svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_1"></svg>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>El facilitador motiva y despierta interés en los agentes de cambio a través de su exposición</h3>
						<svg width="1000" height="500"style ="padding-left:40px; padding-top:20px"  id ="fac_2"></svg>
						</span>
					</li>
          <li class="row">
						<span class="col-sm-9">
						<h3>El facilitador da retroalimentación a los estudiantes</h3>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_3"></svg>
						</span>
					</li>
          <li class="row">
            <span class="col-sm-9">
            <h3>El facilitador responde con claridad a las preguntas de los estudiantes</h3>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px"  id ="fac_4"></svg>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>En el desarrollo de su exposición el facilitador presenta ejemplos relevantes sobre los temas tratados</h3>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_5"></svg>
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>El facilitador presentó de forma organizada los contenidos abordados</h3>
            </span>
						<span class="col-sm-12">
							<svg width="1000" height="500"  style ="padding-left:40px; padding-top:20px"id ="fac_6"></svg>
					  </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Qué fortalezas identificas en el facilitador?</h3>
						<small>Comentarios: {{$all->count()}}</small>
						@foreach($all as $data)
							<p>{{$data->fa_7}}</p>
						@endforeach
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Qué áreas de mejora identificas en el facilitador?</h3>
						<small>Comentarios: {{$all->count()}}</small>
							@foreach($all as $data)
								<p>{{$data->fa_8}}</p>
							@endforeach
            </span>
          </li>
          <li class="row">
            <span class="col-sm-9">
            <h3>¿Propondría a este facilitador para que dirigiera otro curso de este programa de formación?</h3>
						<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="fac_9"></svg>
            </span>
          </li>
				</ol>
				<div class="divider"></div>
		</div>
	</div>
</div>
@endsection
@section('js-content')
<style>

.bar {
  fill: #187fad;;
}

.bar:hover {
  fill: #0a3345;
}

.d3-tip {
      line-height: 1;
      padding: 6px;
      background: rgba(0, 0, 0, 0.8);
      color: #fff;
      border-radius: 4px;
      font-size: 12px;
    }

    /* Creates a small triangle extender for the tooltip */
    .d3-tip:after {
      box-sizing: border-box;
      display: inline;
      font-size: 10px;
      width: 100%;
      line-height: 1;
      color: rgba(0, 0, 0, 0.8);
      content: "\25BC";
      position: absolute;
      text-align: center;
    }

    /* Style northward tooltips specifically */
    .d3-tip.n:after {
      margin: -2px 0 0 0;
      top: 100%;
      left: 0;
    }




</style>
<script src="https://d3js.org/d3.v4.js"></script>
<script src="{{url('js/survey/d3-tip.js')}}"></script>
<script>
var url_1 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_1.csv');?>";
var url_2 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_2.csv');?>";
var url_3 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_3.csv');?>";
var url_4 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_4.csv');?>";
var url_5 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_5.csv');?>";
var url_6 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_6.csv');?>";
var url_9 = "<?php echo url('dashboard/encuestas/get_csv/mo_'.$facilitatorData->session->module->id.'_sess_'.$facilitatorData->session->id.'_fac_'.$facilitatorData->facilitator->id.'_fa_9.csv');?>";
var total = {{$all->count()}};
</script>
<script src="{{url('js/survey/survey-facilitator.js')}}"></script>
@endsection
