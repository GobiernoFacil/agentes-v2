@extends('layouts.admin.a_master')
@section('title', 'Lista de evaluaciones' )
@section('description', 'Lista de tareas y evaluaciones')
@section('body_class', 'fellow')

@section('content')
@if($modules->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Evaluaciones/Tareas</h1>
		{{ $modules->links() }}
		<?php $count_modules = 1; ?>
		@foreach ($modules as $module)
		<div class="box">
			<h1 class="center">Módulo {{$count_modules}}: <strong>{{$module->title}}</strong></h1>
			<div class="row table_t">
				<div class="col-sm-offset-5 col-sm-2">
				  <p>Tipo de Evaluación</p>
				</div>
				<div class="col-sm-2">
				  <p>Fecha límite</p>
				</div>
				<div class="col-sm-3">
				  <p>Estatus</p>
				</div>
			</div><!--row ends-->
			<div class="col-sm-12">
				<div class="divider"></div>
			</div>
			@foreach($module->sessions as $session)
			<div class="col-sm-5">
				<h2 class="title">Sesión {{$session->order}}: <strong>{{$session->name}}</strong></h2>
			</div>
			<!--lista evaluaciones-->
			<div class="session_list">
				@if($session->activity_eval($session->id)->count() > 0)
					@foreach($session->activity_eval($session->id) as $activity)
					<div class="row">
						<!--divider-->
						<div class="col-sm-11 col-sm-offset-1">
						  <div class="divider"></div>
						</div>
						<!--- título-->
						<div class="col-sm-4 col-sm-offset-1">
            			  <h5>Actividad {{$activity->order}}</h5>
            			  <h3><a href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'>{{$activity->name}}</a></h3>
            			</div>
            			<!--- tipo de evaluación-->
            			<div class="col-sm-2">
            			  <p>{{$activity->files === "Sí" ? 'Ensayo' : 'Examen'}}
            			</div>
            			<!--fecha-->
            			<div class="col-sm-2">
            				<p><strong><span>{{!empty($activity->end) ? \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans() : 'Sin fecha'}}</span></strong><br>
	            				{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</p>
            			</div>
						<!--- status-->
						<div class="col-sm-3">
						  @if($activity->files==='Sí')
						    @if($user->FellowFileUp($user->id,$activity->id))
						      <p><strong>Completada</strong></p>
						    @else
						      <div class="header_note">
						        <p><strong>Sin archivos</strong></p>
						      </div>
						      @if($activity->end >= $today )
						      <a class="btn view block " href='{{ url("tablero/archivos/{$activity->slug}/agregar")}}'>Subir archivo</a>
						      @else
						        <div class="footnote">
						            <p>El tiempo de la actividad ha terminado</p>
						        </div>
						      @endif
						    @endif
						  @else
						    @if($activity->quizInfo)
						      @if($user->FellowScoreActivity($user->id,$activity->quizInfo->id))
						        <p><strong>Completada</strong></p>
						      @else
						        <div class="header_note">
						        <p>Sin completar</p>
						        </div>
						        @if($activity->end >= $today )
						        <a class="btn view block " href='{{ url("tablero/evaluacion/{$activity->slug}")}}'>Comenzar evaluación</a>
						        @else
						        <div class="footnote">
						            <p>El tiempo de la actividad ha terminado</p>
						              </div>
						        @endif
						      @endif
						    @else
						      <div class="header_note">
						        <p>Sin completar</p>
						      </div>
						      @if($activity->end >= $today )
						        <a class="btn view block " href='{{ url("tablero/evaluacion/{$activity->slug}")}}'>Comenzar evaluación</a>
						        @else
						        <div class="footnote">
									<p>El tiempo de la actividad ha terminado</p>
						        </div>
						      @endif
						    @endif
						  @endif
						</div>
						
					</div><!--row ends-->
					@endforeach
				@else
					<div class="row">
						<!--divider-->
						<div class="col-sm-11 col-sm-offset-1">
						  <div class="divider"></div>
						</div>
						<!--- título-->
						<div class="col-sm-3 col-sm-offset-5">
            			  <p>Sin evaluaciones</p>
            			</div>
					</div>
				@endif
            </div><!--lista ends-->
			@endforeach
			<?php $count_modules++;?>
		</div><!-- box ends-->
		@endforeach
   </div>
</div>
@else
<div class="row">
	<div class="col-sm-9">
		<h1>Evaluaciones/Tareas</h1>
	</div>
</div>
<div class="box">
	<div class="row center">
		<div class="col-sm-10 col-sm-offset-1">
		<h2>Sin evaluaciones</h2>
		</div>
	</div>
</div>
@endif
@endsection
