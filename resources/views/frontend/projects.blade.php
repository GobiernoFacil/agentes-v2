@extends('layouts.frontend.master')
@section('title', 'Conoce los proyectos del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Conoce los proyectos del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible ')
@section('body_class', 'programa aliados')
@section('canonical', url('proyectos'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1>PROGRAMA DE FORMACIÓN DE <strong>AGENTES LOCALES DE CAMBIO</strong> EN <strong>GOBIERNO ABIERTO</strong> Y DESARROLLO SOSTENIBLE</h1>
		<h2>Conoce los proyectos por estado</h2>
    <div class="row">
			<div class="col-sm-9">
			@foreach($states as $state)
      <h2 class="row">
        <span class="col-sm-10"><a href="{{url('proyectos/'.str_slug($state))}}">
        <?php
        $slug_n  = str_replace('-','_',str_slug($state));
        $info_name = 'infografia_'.$slug_n.'.jpg';
        ?>
				<img src="/archivos/estados/{{strtolower(ucwords(str_replace(' ','-',$state)))}}/{{$info_name}}">
        </a></span>
      </h2>
			@endforeach
			</div>

			<div class="col-sm-3">
				<h2></h2>
				<a href="{{url('programa-gobierno-abierto/alcance')}}" class="icon i_alcance"><span>ALCANCE DEL PROGRAMA</span></a>
				<a href="{{url('programa-gobierno-abierto/aliados')}}" class="icon i_aliados">CONOCE A LOS ALIADOS</a>
				<a href="{{url('programa-gobierno-abierto/antecedentes')}}" class="icon i_antecedentes">ANTECEDENTES</a>
			</div>

		</div>

	</div>
</div>
@endsection
