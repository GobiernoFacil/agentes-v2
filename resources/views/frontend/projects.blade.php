@extends('layouts.frontend.master')
@section('title', 'Conoce los proyectos del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Conoce los proyectos del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible ')
@section('body_class', 'programa aliados')
@section('canonical', url('proyectos-de-aceleracion-y-red-de-ga-y-ds'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>Conoce los Proyectos de aceleración y Red de <strong>GOBIERNO ABIERTO</strong> y <strong>DESARROLLO SOSTENIBLE</strong> por estado</h1>
    <div class="row">
			<div class="col-sm-9">
			@foreach($states as $state)
				<div class="row">
				  <div class="col-sm-12">
					  <h2><a href="{{url('proyectos-de-aceleracion-y-red-de-ga-y-ds/'.str_slug($state))}}">{{$state}}</a></h2>
					  <a href="{{url('proyectos-de-aceleracion-y-red-de-ga-y-ds/'.str_slug($state))}}">
				  <?php
				  $slug_n  = str_replace('-','_',str_slug($state));
				  $info_name = 'infografia_'.$slug_n.'.jpg';
				  ?>
				  		<img src="/archivos/estados/{{strtolower(ucwords(str_replace(' ','-',$state)))}}/{{$info_name}}">
				  </a>
				  </div>
				
				</div>
			@endforeach
			</div>

			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('red-de-gobierno-abierto-desarrollo-sostenible-de-las-americas')}}" class="icon i_antecedentes">Red de Gobierno Abierto y Desarrollo Sostenible de las Américas</a>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

	</div>
</div>
@endsection
