{!! Form::open(['url' => 'convocatoria/aplicar', "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
		<p>{{$activity->quizInfo->description}}</p>
	</div>
</div>
  <?php $countP =1;?>
  @foreach($activity->quizInfo->question as $question)
  <div class="row">
    <div class="col-sm-12">
      <p>
        <label><strong>{{$question->question}}</strong> <br></label>
        <?php $count =0;?>
        @foreach($question->answer as $answer)
          <p>
          <label>{{Form::radio('answer_q'.$countP.'['.$count.']','1', null,['class' => 'form-control answer_q'.$countP])}}{{$answer->value}} </label>
            <?php $count++;?>
            </p>
        @endforeach
      </p>
    </div>
  </div>
    <?php $countP++;?>
  @endforeach
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<p>{{Form::submit('Guardar', ['class' => 'btn gde i_convoca_w'])}}</p>
	</div>
</div>
{!! Form::close() !!}
