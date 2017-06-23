@extends('layouts.admin.a_master')
@section('title', 'Evaluación de'. $activity->name )
@section('description', 'Evaluación de'.  $activity->name)
@section('body_class', 'fellow aprendizaje modulos')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Evaluación {{$activity->quizInfo->title}}</h1>
  </div>
</div>

<div class="box">
  <div class="row">
    <div class="col-sm-10 col-sm-offset-1">
      @include('fellow.evaluation.forms.template-form')
    </div>
  </div>
</div>
@endsection
@section('js-content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  <?php $countP =1;?>
  @foreach($activity->quizInfo->question as $question)
    <?php $count =0;?>
    @foreach($question->answer as $answer)
    $('.answer_q{{$countP}}').click(function(event) {
       $('.answer_q{{$countP}}').not(this).attr('checked', false);
       $(this).attr('checked', true);
     });
    <?php $count++;?>
    @endforeach
    <?php $countP++;?>
  @endforeach
});
</script>
@endsection