{!! Form::open(['url' => url("tablero/diagnostico/$activity->diagnostic_info->slug"), "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">{{$activity->diagnostic_info->title}}</h2>
    <p>{{$activity->diagnostic_info->description}}</p>
  </div>
</div>

<?php $count = 1; ?>
<ol>
  @foreach($activity->diagnostic_info->questions as $question)
  <li class="row">
    @if($question->type ==="open")
      @include('fellow.diagnostic.includes.open_question_template')
    @elseif($question->type ==="radio")
      @include('fellow.diagnostic.includes.radio_question_templade')
    @elseif($question->type === "answers")
        <div class="col-sm-12">
          <h3 class="title"><strong>{{$question->question}}{{$question->required ? "" : " (opcional)"}}</strong></h3>
        </div>
        <div class="col-sm-12">
        @if($errors->has('answer_q'.$count))
        <strong class="danger">{{$errors->first('answer_q'.$count)}}</strong>
        @endif
        </div>
      <div class="col-sm-10 col-sm-offset-1">
            <?php $countP =0;?>

            @foreach($question->answers as $answer)
              <div class="divider b"></div>
                <p class="row"><label><span class="col-sm-1">{{Form::radio('answer_q'.$count.'['.$countP.']',$answer->id, null,['class' => 'form-control answer_q'.$count,'id'=>'answer_'.$count.'_'.$countP])}}</span><span class="col-sm-11">{{$answer->value}}</span></label>
                <?php $countP++;?>
                </p>
            @endforeach
            @if($question->count_correct($question->id)>1)
            <div class="divider b"></div>
              <p class="right"><a hred="#" class="btn xs danger" id='{{"delete".$countP."_".$count}}'>Borrar respuestas seleccionadas en la pregunta {{$count}}</a></p>
            <script>
            $('#delete{{$count}}_{{$countP}}').click(function(event) {
                event.preventDefault();
                $('.answer_q{{$count}}').not(this).attr('checked', false);
             });
            </script>
        @endif
        </div>
    @endif
  </li>
    <?php $count++;?>
  @endforeach
</ol>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Enviar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
