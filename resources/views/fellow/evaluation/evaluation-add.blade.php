@extends('layouts.admin.a_master')
@section('title', $activity->quizInfo->title )
@section('description', 'Evaluación de'.  $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'view questions')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_quiz')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>{{$activity->quizInfo->title}}</h1>
    <p><strong>Instrucciones:</strong> Selecciona las respuestas correctas.</p>
  </div>
</div>

<div class="box">
  <div class="row">
    <div class="col-sm-12">
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
    @if($question->count_correct($question->id)==1)
      @foreach($question->answer as $answer)
      $('.answer_q{{$countP}}').click(function(event) {
         $('.answer_q{{$countP}}').not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
      <?php $count++;?>
      @endforeach
    @else
    console.log("delete");
      $('.delete{{$countP}}_{{$count}}').click(function(event) {
          event.preventDefault();
          console.log('this');
          $('.answer_q{{$countP}}').not(this).attr('checked', false);
       });
    @endif
    <?php $countP++;?>
  @endforeach
});
</script>
@endsection
