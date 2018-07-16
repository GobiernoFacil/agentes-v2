@extends('layouts.admin.a_master')
@section('title', 'Lista de módulos  - '.$program->title)
@section('description', 'Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'evaluation')
@section('breadcrumb_type', 'evaluation module list')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_evaluation')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Evaluaciones</h1>
		<h2>{{$program->title}}</h2>
	</div>
</div>
@if($modules->count() > 0)
  @foreach($modules as $module)
   	@if($module->get_all_evaluation_activity()->count()>0)
        <div class="module">
        	<div class="m_header">
        		<div class="row">
        			<div class="col-sm-6">
        				<h4>Semana {{$module->order}} {!! $module->modality == "Presencial" ?  '<span>('.$module->modality.')</span>' : '' !!}</h4>
        			</div>
        		</div>
        	</div>
        	<!--content-->
        	<div class="m_content">
        		<div class="row">
        			<div class="col-sm-12">
        				<!-- title-->
        				<h3>
        					{{$module->title}}
                  <p><span class = 'notes '>Del {{date('d-m-Y', strtotime($module->start))}} al {{date('d-m-Y', strtotime($module->end))}}</span></p>
        				</h3>
        			</div>
        			<div class="col-sm-12">
        					@if($module->get_all_evaluation_activity()->count()>0)
                  <div class="row">
                      <div class="col-sm-4">
                        <h4>Actividades evaluación</h4>
                      </div>
                      <div class="col-sm-3">
                        <h4>Fechas</h4>
                      </div>
                      <div class="col-sm-2">
                        <h4>No. Fellows</h4>
                      </div>
                      <div class="col-sm-3">
                        <h4>Acciones</h4>
                      </div>
                  	</div>
        						@foreach($module->get_all_evaluation_activity() as $evAct)
											@if($evAct->id != 431)
		                    <div class="row">
			        							<div class="col-sm-4">
															@if($evAct->type==='evaluation' )
															  @if($evAct->files)
																<h5>Archivo</h5>
																@else
																<h5>Evaluación</h5>
																@endif
															@elseif($evAct->type==='diagnostic')
																<h5>Diagnóstico</h5>
															@elseif($evAct->type==='final')
																<h5>Evaluación Final</h5>
															@endif

			                        @if($evAct->type==='evaluation' || $evAct->type==='final' )
			          								<p><a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$evAct->id") }}'>{{$evAct->name}}</a></p>
			          							@elseif($evAct->type==='diagnostic')
			          								<p><a href='{{ url("dashboard/programas/$program->id/ver-diagnostico/$evAct->id") }}'>{{$evAct->name}}</a></p>
			          							@endif
			        							</div>
			        							<div class="col-sm-3">
			                        @if($module->start)
			        								<p>{{date("d-m-Y", strtotime($module->start))}} al <br>{{date('d-m-Y', strtotime($evAct->end))}}</p>
			                        @else
			                        <p>Sin fechas</p>
			                        @endif
			        							</div>

			                      <div class="col-sm-2">
			                        @if($evAct->type==='evaluation' )
			                          @if($evAct->files)
			                            <p>{{$evAct->count_fellow_file_evaluations()}}</p>
			                          @else
			                            <p>{{$evAct->count_fellow_evaluations() ? $evAct->count_fellow_evaluations()  : 0 }}</p>
			                          @endif
															@elseif($evAct->type==='final' )
																 @if($evAct->files)
																	 <p>{{$evAct->count_fellow_file_evaluations()}}</p>
																 @else
																	 <p>0</p>
																 @endif
			                        @elseif($evAct->type==='diagnostic')
			                          <p>{{$evAct->count_fellow_diagnostic()}}</p>
			                        @endif
			        							</div>
			                      <div class="col-sm-3">
			                        @if($evAct->type==='evaluation' || $evAct->type==='final' )
			          								<p><a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$evAct->id") }}' class ="btn xs view">Ver</a></p>
			          							@elseif($evAct->type==='diagnostic')
			          								<p><a href='{{ url("dashboard/programas/$program->id/ver-diagnostico/$evAct->id") }}' class ="btn xs view">Ver</a></p>
			          							@endif
			        							</div>
		                     </div>
											@endif
        						@endforeach
        					@endif
        			</div>
        		</div>
        	</div>
        </div>
    @endif
  @endforeach
  {{$modules->links()}}
@else
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin módulos</h2>
		</div>
	</div>
</div>
@endif
@endsection
