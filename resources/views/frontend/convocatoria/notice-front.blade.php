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
	        	<div class="col-sm-4">
				@if($notice->files_front()->count()>0)
			    	@foreach($notice->files_front() as $file)
					<p><a href='{{url("convocatoria/archivos/$file->name")}}' class="btn gde download i_download">{{$file->comments}}</a></p>
					@endforeach
					@endif
          		</div>
		  		<div class="col-sm-4">
	        		<a href='{{url("convocatoria/preguntas-frecuentes")}}' class="btn gde view faqs">Preguntas Frecuentes</a>
          		</div>
		  		<div class="col-sm-4">
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
				<!--objetivo-->
				<li>
            		<h3>Objetivo</h3>
					<span></span>
					<div class="panel">
            		{!! $notice->objective !!}
            		</div>
				</li>
				<!--Modalidad-->
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
				<!--perfil-->
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
				<!--plazos-->
				<li>
				  <h3>Plazos y proceso de postulación</h3>
				  <span></span>
				  <div class="panel">
				    {!! $notice->term_process !!}
				  </div>
				</li>
				<!--casos-->
				<li>
				  <h3>Casos no previstos</h3>
				  <span></span>
				  <div class="panel">
				    {!! $notice->unforeseen_cases !!}
				  </div>
				</li>
				<!--contacto-->
				<li>
				  <h3>Contacto</h3>
				  <span></span>
				  <div class="panel">
				    {!! $notice->contact !!}
				  </div>
				</li>
        	</ol>
			<h2><a href='{{url("convocatoria/aplicar/$notice->slug")}}' class="btn gde i_convoca_w">Aplicar a convocatoria</a></h2>
        </div>
        
        <!--notes--->
        <div class="col-sm-8 col-sm-offset-2">
	        <div class="notes">
				<p> <a id="note1"></a> <sup>1</sup> La realización de este programa es posible gracias al apoyo y financiamiento otorgado por USAID en el marco del proyecto: “<em>Local Capacities in Open Government (OG) for the Achievement of the Sustainable Development Goals (SDGs) in Mexico</em> /Programa de fortalecimiento de capacidades en gobierno abierto para el cumplimiento de los objetivos de desarrollo sostenible en lo local.”<br>
				<a id="note2"></a> <sup>2</sup> Por cumplimiento de los requisitos académicos se entiende que el participante realice todas las actividades en línea y presenciales de aprendizaje previstas durante el programa. Se tiene prevista una carga semanal de alrededor de seis horas dedicadas a las actividades del curso. Asimismo, se espera que el participante colabore activamente en la realización del proyecto final.<br> 
				<a id="note3"></a> <sup>3</sup> Los datos personales recabados, serán protegidos de acuerdo con lo establecido en el Aviso de Privacidad de la Convocatoria al Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible Edición 2018, disponible en <a href="{{url('')}}">www.apertus.org.mx</a>. <br>
				<a id="note4"></a> <sup>4</sup> El video puede realizarse con cualquier dispositivo (teléfono móvil, tableta o cámara digital), y deberá ser subido a la plataforma en línea <a href="https://www.youtube.com">www.youtube.com</a> </p>
			</div>
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