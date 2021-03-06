@extends('layouts.admin.a_master')
@section('title', 'Evaluación diagnóstico '. $activity->diagnostic_info->title)
@section('description', 'Evaluación diagnóstico '. $activity->diagnostic_info->title)
@section('body_class', 'fellow aprendizaje')
@section('breadcrumb_type', 'custom view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_diagnostic')
@section('content')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<div class="row">
  <div class="col-sm-12">
    <h1>Cuestionario diagnóstico</h1>
  </div>
</div>
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      @include('fellow.diagnostic.forms.custom-diagnostic-form')
    </div>
  </div>
</div>
@endsection

@section('js-content')

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script type="application/javascript">

  $(document).ready(function() {
    @foreach($activity->diagnostic_info->questions as $question)
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

  $(document).ready(function() {
    <?php $countP =1;?>
    @foreach($activity->diagnostic_info->questions as $question)
      <?php $count =0;?>
      @if($question->count_correct($question->id)<=1)
        @foreach($question->answers as $answer)
        $('.question_{{$countP}}').click(function(event) {
           $('.question_{{$countP}}').not(this).attr('checked', false);
           $(this).attr('checked', true);
         });
        <?php $count++;?>
        @endforeach
      @else
        $('.delete{{$countP}}_{{$count}}').click(function(event) {
            event.preventDefault();
            $('.question_{{$countP}}').not(this).attr('checked', false);
         });
      @endif
      <?php $countP++;?>
    @endforeach
  });

</script>
@endsection
