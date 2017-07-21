{!! Form::open(['url' => url("tablero/evaluacion/{$activity->slug}/save"), "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
		<h2>{{$activity->quizInfo->description}}</h2>
		<div class="divider b"></div>
	</div>
</div>
<div class="row">
	<div class="col-sm-10  col-sm-offset-1">
		<ol class="list line">
			<?php $countP =1;?>
			@foreach($activity->quizInfo->question as $question)
			<li class="row">
		    	<div class="col-sm-12">
		    		<h3 class="title">{{$question->question}}</h3>
		    	</div>
		    	<div class="col-sm-12">
		    	@if($errors->has('answer_q'.$countP))
		    	<strong class="danger">{{$errors->first('answer_q'.$countP)}}</strong>
		    	@endif
		    	</div>
				<div class="col-sm-10 col-sm-offset-1">
		        	<?php $count =0;?>
					
			        @foreach($question->answer as $answer)
			          	<p class="row"><label><span class="col-sm-1">{{Form::radio('answer_q'.$countP.'['.$count.']',$answer->id, null,['class' => 'form-control answer_q'.$countP,'id'=>'answer_'.$countP.'_'.$count])}}</span><span class="col-sm-11">{{$answer->value}}</span></label>
			            <?php $count++;?>
						</p>
						<div class="divider b"></div>
			        @endforeach
			        @if($question->count_correct($question->id)>1)
					<p><a hred="#" class="btn xs view" id='{{"delete".$countP."_".$count}}'>Borrar respuestas seleccionadas en la pregunta {{$countP}}</a></p>
					@endif
		    	</div>
		  </li>
		    <?php $countP++;?>
		  @endforeach
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<p>{{Form::submit('Evaluar respuestas', ['class' => 'btn gde'])}}</p>
	</div>
</div>
{!! Form::close() !!}
