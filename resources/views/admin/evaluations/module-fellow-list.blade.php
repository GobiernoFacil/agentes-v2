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
                    <div class="row">
        							<div class="col-sm-4">
        								<h5>{{$evAct->type ==='evaluation' ? $evAct->files ? 'Archivo' : 'Evaluación' : 'Diagnóstico'}}</h5>
                        @if($evAct->type==='evaluation' )
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
                        @elseif($evAct->type==='diagnostic')
                          <p>{{$evAct->count_fellow_diagnostic()}}</p>
                        @endif
        							</div>
                      <div class="col-sm-3">
                        @if($evAct->type==='evaluation' )
          								<p><a href='{{ url("dashboard/programas/$program->id/ver-evaluacion/$evAct->id") }}' class ="btn xs view">Ver</a></p>
          							@elseif($evAct->type==='diagnostic')
          								<p><a href='{{ url("dashboard/programas/$program->id/ver-diagnostico/$evAct->id") }}' class ="btn xs view">Ver</a></p>
          							@endif
        							</div>
                    </div>
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
