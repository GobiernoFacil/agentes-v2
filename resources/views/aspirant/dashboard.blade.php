@extends('layouts.admin.a_master')
@section('title', 'Tablero de Control')
@section('description', 'Tablero de control de la plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'dashboard')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Tablero de control</h1>
	</div>
</div>

<div class="row">
	<div class="col-sm-3">
		<div class="box">
			<p>En este tablero podrás consultar las convocatorias y los procesos de selección del <strong>Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong>.</p>
		</div>
		<div class="box">
			<p><a href="{{ url('tablero-aspirante/perfil/editar') }}" class="btn view">Editar información de tu perfil</a></p>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<!--convocatorias-->
			<div class="col-sm-12">
				<div class="box news">
					<h3 class="sa_title">Convocatorias</h3>
					<p></p>
					@if($notices->count()>0)
					<ul class="list line">
						@foreach($notices as $notice)
						@endforeach
					</ul>
					<div class="row">
						<div class="col-sm-12">
							<div class="divider"></div>
						</div>
						<div class="col-sm-8 col-sm-offset-2 center">
							<p><a href="{{url('tablero-facilitador/noticias')}}" class="btn view gde ">Ver todas las convocatorias</a></p>
						</div>
					@else
					<p>Aún no existen convocatorias.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
	

</div>
@endsection
