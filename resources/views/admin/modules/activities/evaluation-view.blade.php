<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-9">
			<h2 class="title">Evaluación: {{$activity->quizInfo->title}}</h2>
		</div>
    <div class="col-sm-3">
  	   <p class="right"><a href='{{url("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/2")}}' class="btn xs ev">[+] Agregar pregunta</a></p>
  	</div>
		<div class="col-sm-8 col-sm-offset-2">
		<ul class="list line">
      @if($activity->quizInfo->question->count()>0)
          <?php $count  = 1;?>
          @foreach($activity->quizInfo->question as $question)
          <li><h4>Pregunta {{$count}}</h4>
            {{$question->question}}</li>
            <?php $count++;?>
          @endforeach
      @else
      <p>Sin preguntas</p>
      <a href='{{url("dashboard/sesiones/actividades/evaluacion/agregar/$activity->id/2")}}' class="btn xs view">Agregar preguntas</a>
      @endif


    </ul>
		</div>
	</div>
</div>
