@extends('layouts.admin.a_master')
@section('title', 'Lista de Aspirantes')
@section('description', 'Lista de Aspirantes')
@section('body_class', 'aspirantes')
@section('breadcrumb_type', 'aspirants interview add')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_interview')

@section('content')

@if($questionnaire)
	<div class="row">
		<div class="col-sm-9">
			<h1>Entrevista a <strong>{{$interview->aspirant->name }} {{ $interview->aspirant->surname }} {{ $interview->aspirant->lastname }}</strong></h1>
      <h2>Tipo de entrevista: <strong>{{$interview->type === 'face' ? 'Personal' : 'Audio' }}</strong></h2>
		</div>
		<div class="col-sm-3">
			<h4 class="right">{{ $interview->aspirant->city }}, {{ $interview->aspirant->state }} </h4>
		</div>
	</div>

	<div class="row">
		<div class="box">
			<div class="col-sm-10 col-sm-offset-1">
			  @include('admin.aspirants.interviews.form.evaluation-form')
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
@else
	<h1>La convocatoria no cuenta con cuestionario para entrevista.</h1>
	<div class="box">
		<p><a href='{{ url("dashboard/aspirantes/convocatoria/$notice->id/entrevistas/evaluar-entrevista/{$interview->aspirant->id}") }}' class="btn">&lt;&lt; Regresar a lista de aspirantes.</a></p>
	</div>
@endif

@endsection

@section('js-content')

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  @foreach($questionnaire->questions as $question)
    @if($question->options_rows_number >1)
      @foreach($question->answers as $answer)
      $("{{'.question_'.$question->id.'_'.$answer->id}}").click(function(event) {
         $("{{'.question_'.$question->id.'_'.$answer->id}}").not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
      @endforeach

    @elseif($question->options_rows_number === 1)
      $("{{'.question_'.$question->id}}").click(function(event) {
         $("{{'.question_'.$question->id}}").not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
    @endif
  @endforeach
});

</script>
@endsection
