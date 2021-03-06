<!-- multiple_answers -->
<div class="col-sm-12">
  <h3 class="title"><strong>{{$question->question}}{{$question->required ? "*" : " (opcional)"}}</strong></h3>
    @if($question->count_correct($question->id) > 1)
      <h4> Selecciona {{$question->count_correct($question->id)}} respuestas</h4>
    @endif
</div>
<div class="col-sm-10 col-sm-offset-1">
    <?php $countP =0;?>
    @foreach($question->answers as $answer)
      <div class="divider b"></div>
        <p class="row">
          <label>
            <span class="col-sm-1">
              {{Form::radio('question_'.$count.'_'.$question->id.'['.$countP.']',$answer->id, null,['class' => 'form-control question_'.$count,'id'=>'question'.$count.'_'.$countP])}}
            </span>
            <span class="col-sm-11">{{$answer->value}}</span>
        </label>
        <?php $countP++;?>
       </p>
    @endforeach
    @if($question->count_correct($question->id) > 1)
      <div class="divider b"></div>
        <p class="right">
          <a hred="#" class="btn xs danger" id='{{"delete".$count."_".$countP}}'>Borrar respuestas seleccionadas en la pregunta {{$count}}</a>
        </p>
      <script type="application/javascript">
        $('#delete{{$count}}_{{$countP}}').click(function(event) {
            event.preventDefault();
            $('.question_{{$count}}').not(this).attr('checked', false);
         });
      </script>
    @endif
</div>
