@extends('layouts.admin.a_master')
@section('title', '')
@section('description', 'plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', '')
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Ver calificación {{$score->quizInfo->title}}</h1>
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
          @foreach($score->quizInfo->question as $question)
					<li class="row">
						<span class="col-sm-9">
						<h3>{{$question->question}}</h3>
						<p><strong>Tu respuesta:</strong> {{$userf->fellowAnswer($question->id,$userf->id)->answer->value}}</p>
            @if(!$userf->fellowAnswer($question->id,$userf->id)->correct)
            <p><strong>Respuesta correcta:</strong> {{$question->correct_Answer($question->id)->value}}</p>
            @endif
						</span>
						<span class="col-sm-3 right">
              @if($userf->fellowAnswer($question->id,$userf->id)->correct)
              <p><strong>Correcta </strong></p>
              @else
							<p><strong class ="danger">Incorrecta </strong></p>
              @endif
						</span>
					</li>
          @endforeach

            	</ol>
		    </div>
    @else
    	<div class="col-sm-12">
       	 <p>Aún no has realizado la evaluación</p>
    	</div>
    @endif
  </div>
</div>
@endsection
