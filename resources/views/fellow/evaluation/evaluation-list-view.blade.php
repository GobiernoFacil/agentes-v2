@extends('layouts.admin.a_master')
@section('title', 'Lista de evaluaciones' )
@section('description', 'Lista de tareas y evaluaciones')
@section('body_class', 'fellow')

@section('content')

@if($activities->count() > 0)
<div class="row">
	<div class="col-sm-12">
		<h1>Evaluaciones</h1>
	</div>
	
	<div class="col-sm-12">
          <div class="box session_list">
		@foreach ($activities as $activity)
            <div class="row">
              <!-- footnote-->
                <div class="header_note">
                  <div class="row">
                   <div class="col-sm-4">
                     <p class="right">Fecha límite:</p>
                   </div>
                    <div class="col-sm-8">
                      <p><strong><span>{{!empty($activity->end) ? \Carbon\Carbon::createFromTimeStamp(strtotime($activity->end))->diffForHumans() : 'Sin fecha'}}</span></strong></p>
                        <p>{{ !empty($activity->end) ? date("j/m/Y", strtotime($activity->end)) : 'Sin fecha'}}</p>
                    </div>
                  </div>
                </div>

              <div class="col-sm-12">
                <h5>Actividad {{$activity->order}}</h5>
                <h2><a href='{{url("tablero/aprendizaje/{$activity->session->slug}/{$activity->session->slug}/$activity->id")}}'>{{$activity->name}}</a></h2>
                 <!-- footnote-->
                <div class="footnote">
                  <div class="row">
                    <div class="col-sm-12">
                        <p><strong>Módulo</strong>: {{$activity->session->module->title}}</p>
                        <p><strong>Sesión</strong>: {{$activity->session->name}}</p>
                    </div>
                  </div>
                </div>
                <div class="divider b"></div>
                  <div class="row">
                    <div class="col-sm-12">
                      <p>{{$activity->description}}</p>
                    </div>
                  </div>
                </div>
                <!-- ver sesión-->
                <div class="col-sm-12">
                  @if($activity->end >= $today )
                        @if($activity->files==='Sí')
                          @if($user->FellowFileUp($user->id,$activity->id))
                          <div class="box blue center">
                            <h2>Ya cuentas con un archivo</h2>
                          </div>
                          @else
                          <a class="btn view block sessions_l" href='{{ url("tablero/archivos/{$activity->slug}/agregar")}}'>Comenzar evaluación</a>
                          @endif
                        @else
                          @if($activity->quizInfo)
                            @if($user->FellowScoreActivity($user->id,$activity->quizInfo->id))
                            <div class="box blue center">
                      				<h2>Ya respondiste el examen</h2>
                      			</div>
                          @else
                          <div class="box blue center">
                            <h2>La evaluación aún no esta disponible</h2>
                          </div>
                          @endif
                          @else
                          <a class="btn view block sessions_l" href='{{url("tablero/evaluacion/{$activity->slug}")}}'>Comenzar evaluación</a>
                          @endif
                        @endif
                  @else
                  <div class="box blue center">
        						<h2>El tiempo de la actividad ha terminado</h2>
        					</div>
                  @endif
                </div>

            </div>
			    @endforeach
          </div>
  {{ $activities->links() }}
          </div>
  </div>

@else
<div class="row">
	<div class="col-sm-9">
		<h1>Evaluaciones</h1>
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
