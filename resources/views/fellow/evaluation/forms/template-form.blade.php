{!! Form::open(['url' => url("tablero/evaluacion/{$activity->slug}/save"), "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
		<h2>{{$activity->quizInfo->description}}</h2>
		<div class="divider b"></div>
	</div>
</div>
<ol class="list line">
	<?php $countP =1;?>
	@foreach($activity->quizInfo->question as $question)
	<li class="row">
    	<div class="col-sm-10 col-sm-offset-1">
    		<h3>{{$question->question}}</h3>
    	</div>
    	<div class="col-sm-10 col-sm-offset-1">
    	@if($errors->has('answer_q'.$countP))
    	<strong class="danger">{{$errors->first('answer_q'.$countP)}}</strong>
    	@endif
    	</div>
		<div class="col-sm-9 col-sm-offset-2">
        	<?php $count =0;?>
			<ul class="list line">
	        @foreach($question->answer as $answer)
	          	<li><label>{{Form::radio('answer_q'.$countP.'['.$count.']',$answer->id, null,['class' => 'form-control answer_q'.$countP,'id'=>'answer_'.$countP.'_'.$count])}}{{$answer->value}} </label>
	            <?php $count++;?>
				</li>
	        @endforeach
			</ul>
	        @if($question->count_correct($question->id)>1)
			<p><a hred="#" class="btn xs view" id='{{"delete".$countP."_".$count}}'>Borrar respuestas seleccionadas</a></p>
			@endif
    	</div>
  </li>
    <?php $countP++;?>
  @endforeach
</ol>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<p>{{Form::submit('Evaluar respuestas', ['class' => 'btn gde'])}}</p>
	</div>
</div>
{!! Form::close() !!}
