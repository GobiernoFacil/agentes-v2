<!--archivos-->
<div class="box">
  <div class="row">
    @if($activity->diagnostic_info)
    <div class="col-sm-9">
      <h2 class="title">Evaluación diagnóstico: {{$activity->diagnostic_info->title}}</h2>
    </div>
    <div class="col-sm-3">
      <p class="right"><a href='{{url("dashboard/sesiones/actividades/diagnostico/agregar/$activity->id/2")}}' class="btn xs ev">[+] Agregar pregunta</a></p>
    </div>
    <div class="col-sm-8 col-sm-offset-2">
      <ul class="list line">
        @if($activity->diagnostic_info->questions->count()>0)
        <?php $count  = 1;?>
        @foreach($activity->diagnostic_info->questions as $question)
        <li><h4>Pregunta {{$count}} {{$question->required ? '(Obligatoria)' : ''}}</h4>
          <h5 class = "small">{{$question->type === 'radio' ? 'Pregunta de escala' : $question->type ==='open' ? 'Pregunta abierta' : 'Pregunta de opción múltiple'}}</h5>
          {{$question->question}}
          @if($question->type ==='answers')
            <ul>
             @foreach($question->answers as $answer)
             <li>{{$answer->value}}
             	@if($answer->selected === 1)
             	<span class="success">Respuesta correcta</span></li>
             	@endif
              @endforeach
            </ul>

          @endif
          </li>
          <?php $count++;?>
          @endforeach
          @else
          <p>Sin preguntas</p>
          <a href='{{url("dashboard/sesiones/actividades/diagnostico/agregar/$activity->id/2")}}' class="btn xs view">Agregar preguntas</a>
          @endif
        </ul>
      </div>
      @else
      <div class="col-sm-9">
        <h2 class="title">Evaluación diagnóstico</h2>
      </div>
      <div class="col-sm-12">
        <ul class="list line">
        <p>Sin cuestionario</p>
        <a href='{{url("dashboard/sesiones/actividades/diagnostico/agregar/$activity->id/1")}}' class="btn xs view">Agregar cuestionario</a>
      </ul>
      </div>
      @endif
    </div>
  </div>
