@extends('layouts.admin.a_master')
@section('title', 'Calificaciones')
@section('description', 'Calificaciones')
@section('body_class', 'fellow')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación {{$activity->quizInfo->title}}</h1>
  </div>
</div>

<div class="box">
  <div class="row">
      @if($score)
	   		<div class="col-sm-3 col-sm-offset-9 right">
				<h3>Puntaje total: </h3>
				<h2>{{$score->score > 0 ? number_format($score->score,2) . '/10' : '0/0'  }}</h2>
			</div>
		    <div class="col-sm-12">
				<div class="divider top"></div>
				<ol class="list line">
          @foreach($activity->quizInfo->question as $question)
            @if($question->count_correct($question->id)>1)
              <li class="row">
                <span class="col-sm-9">
                <h3>{{$question->question}}</h3>
                <p><strong>Tus respuestas:</strong></p>
                @foreach($user->fellowMultipleAnswers($question->id,$user->id) as $answerM)
                    <p> {{$answerM->answer->value}}</p>
                @endforeach
                @if($user->count_incorrect($question->id,$user->id)>=1)
                  <p><strong>Respuestas correctas:</strong></p>
                  @foreach($question->all_correct_Answer($question->id) as $answerM)
                      <p> {{$answerM->value}}</p>
                  @endforeach
                @endif
                </span>
                <span class="col-sm-3 right">
                  @if($user->count_incorrect($question->id,$user->id)>=1)
                  <p><strong class ="danger">Incorrecta </strong></p>
                  @else
                  <p><strong>Correcta </strong></p>
                  @endif
                </span>
              </li>

            @else
    					<li class="row">
    						<span class="col-sm-9">
    						<h3>{{$question->question}}</h3>
    						<p><strong>Tu respuesta:</strong> {{$user->fellowAnswer($question->id,$user->id)->answer->value}}</p>
                @if(!$user->fellowAnswer($question->id,$user->id)->correct)
                <p><strong>Respuesta correcta:</strong> {{$question->correct_Answer($question->id)->value}}</p>
                @endif
    						</span>
    						<span class="col-sm-3 right">
                  @if($user->fellowAnswer($question->id,$user->id)->correct)
                  <p><strong>Correcta </strong></p>
                  @else
    							<p><strong class ="danger">Incorrecta </strong></p>
                  @endif
    						</span>
    					</li>
            @endif
          @endforeach

            	</ol>
              <a href ="{{ url('tablero/calificaciones') }}"   class="btn view">Continuar</a>
		    </div>
    @else
    	<div class="col-sm-12">
       	 <p>Aún no has realizado la evaluación</p>
    	</div>
    @endif
  </div>
</div>
@endsection
