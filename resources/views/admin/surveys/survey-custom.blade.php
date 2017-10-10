@extends('layouts.admin.a_master')
@section('title', 'Encuesta '.$questionnaire->title)
@section('description', 'Encuesta '.$questionnaire->title)
@section('body_class', '')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Resultados de encuesta <strong>{{$questionnaire->title}}</strong></h1>
	</div>
</div>

<div class="box">
	<div class="row">
		<div class="col-sm-12">
			<div class="divider top"></div>
			<div class="row">
				<span class="col-sm-4 col-sm-offset-8" id ="general_div" style="display:none;">
					<strong>Promedio General: <span id ="general"></span></strong>
				</span>
			</div>

      <ol class="list line">
        @foreach($questionnaire->questions as $question)
    				<li class="row">
    					<span class="col-sm-9">
    						<h3>{{$question->question}}</h3>
                    @if($question->options_rows_number>1)
                        <small><strong>Respuestas: {{$question->answers_fellows->count()/$question->options_rows_number}}</strong></small>
                    @else

        						      <small><strong>Respuestas: {{$question->answers_fellows->count()}}</strong></small>
                    @endif
    					</span>
                @if($question->type ==='radio')
                  @if($question->options_rows_number >1)
                    @foreach($question->answers as $answer)
                      <span class="col-sm-9">{{$answer->answer}}</span>
                      <svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="question_{{$question->id}}_{{$answer->id}}"></svg>
                      <span class="col-sm-9">
                        <strong>Promedio: <span id ="sur_1_av"></span></strong>
                      </span>
                    @endforeach
                  @else
            					<svg width="1000" height="500" style ="padding-left:40px; padding-top:20px" id ="question_{{$question->id}}"></svg>
            					<span class="col-sm-9">
            						<strong>Promedio: <span id ="sur_1_av"></span></strong>
            					</span>
                  @endif
                @elseif($question->type==='open')
                  <span class="col-sm-9">
                        @foreach($question->answers_fellows as $answers)
                        		<p>{{$answers->answer}}</p>
                         @endforeach
                  </span>
                @endif
    				</li>
        @endforeach
      </ol>
    </div>
  </div>
</div>

@endsection
