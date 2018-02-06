@extends('layouts.frontend.master')
@section('title', 'Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('description', 'Convocatoria Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'convocatoria')
@section('canonical', url('convocatoria') )
@section('breadcrumb', 'layouts.frontend.breadcrumb.bread_convocatoria')

@section('content')
  @if($notice)
    <div class="row">
    	<div class="col-sm-10 col-sm-offset-1">
    		
      	<h1>{{$notice->title}}</h1>
      
        {!! $notice->description !!}
        <!--files-->
        <div class="row">
	        <div class="col-sm-6">
			@if($notice->files_front()->count()>0)
			    @foreach($notice->files_front() as $file)
					<p><a href='{{url("convocatoria/archivos/$file->name")}}' class="btn gde download i_download">{{$file->comments}}</a></p>
			    @endforeach
			@endif
          	</div>
          	<div class="col-sm-6">
	        	<a href='{{url("convocatoria/aplicar/$notice->slug")}}' class="btn gde i_convoca_w">Aplicar a convocatoria</a>
          	</div>
          <!-- aspirantes de convocatoria seleccionados
          <div class="col-sm-4">
            <p><a href="{{url('convocatoria/resultados-2017')}}" class="btn gde process">Candidatos Seleccionados</a></p>

          </div>
        -->
    			</div>
      </div>
      <div class="col-sm-8 col-sm-offset-2">
        <h2>Bases</h2>
        <ol class="toggle-view">
          <li>
            <h3>Objetivo</h3>
            <span></span>
            <div class="panel">
            	{!! $notice->objective !!}
            </div>
          </li>

          <li>
            <h3>Modalidad y resultados esperados</h3>
            <span></span>
            <div class="panel">
            	{!! $notice->modality_results !!}
            </div>
          </li>
          <!--perfil de egreso-->
          <li>
            <h3>Perfil de egreso</h3>
            <span></span>
            <div class="panel">
            	{!!$notice->profile!!}
            </div>
          </li>

          <li>
            <h3>Perfil y elegibilidad de los participantes</h3>
            <span></span>
            <div class="panel">
            	{!! $notice->profile_eligibility_description !!}
				<?php /*
				@if(!empty($notice->profile_eligibility_general) || !empty($notice->profile_eligibility_particular)) 
				<div class="row">
				  <div class="col-sm-6">
				  <h4>Criterios Generales</h4>
				  <ol>
				    <li>{!! $notice->profile_eligibility_general !!}</li>
				  </ol>
				    </div>
				    <div class="col-sm-6">
				  <h4>Criterios Particulares</h4>
				  <ol>
				    <li>{!! $notice->profile_eligibility_particular !!}</li>
				  </ol>
				  </div>
				</div>
              	@endif
              	*/?>
            </div>
          </li>

        <li>
          <h3>Plazos y proceso de postulación</h3>
          <span></span>
          <div class="panel">
            {!! $notice->term_process !!}
          </div>
        </li>

        <li>
          <h3>Casos no previstos</h3>
          <span></span>
          <div class="panel">
            {!! $notice->unforeseen_cases !!}
          </div>
        </li>

        <li>
          <h3>Contacto</h3>
          <span></span>
          <div class="panel">
            {!! $notice->contact !!}
          </div>
        </li>
        </ol>
			<h2><a href='{{url("convocatoria/aplicar/$notice->slug")}}' class="btn gde process">Aplicar a convocatoria</a></h2>
        </div>
      
      <div class="col-sm-10 col-sm-offset-1">
	      <div class="divider"></div>
      </div>
      <div class="col-sm-8 col-sm-offset-2">
	      <h3>Convocatorias anteriores</h3>
	      <ul>
		      <li><a href="{{ url('convocatoria/2017') }}">Convocatoria 2017</a></li>
	      </ul>
      </div>
        
    </div>
  @else
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <h2 class="danger">Sin convocatoria abierta</h2>
        </h1>
      </div>
      <div class="col-sm-10 col-sm-offset-1">
	      <div class="divider"></div>
      </div>
      <div class="col-sm-8 col-sm-offset-2">
	      <h3>Convocatorias anteriores</h3>
	      <ul>
		      <li><a href="{{ url('convocatoria/2017') }}">Convocatoria 2017</a></li>
	      </ul>
      </div>
    </div>
  @endif
@endsection
