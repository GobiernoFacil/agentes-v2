{!! Form::open(['url' => url("dashboard/aspirantes/convocatoria/$notice->id/entrevistas/evaluar-entrevista/{$interview->aspirant->id}"), "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">{{$questionnaire->title}}</h2>
    <p>{{$questionnaire->description}}</p>
  </div>
</div>

<?php $count = 1; ?>
<ol>
  @foreach($questionnaire->questions as $question)
  <li class="row">
    @if($question->type ==="open")
    <!-- answer_open -->
      <div class="col-sm-12">
        <p>
          <label><strong>{{$question->question}}{{$question->required ? "" : " (opcional)"}}</strong><br>
            <p>{{$question->observations ?  $question->observations : ""}}</p>
          {{Form::textarea('question_'.$count.'_'.$question->id,null, ["class" => "form-control"])}} </label>
          @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id)}}</strong>
          @endif
        </p>
        <div class="divider"></div>
    </div>
    @elseif($question->type ==="radio")
    <!-- answer_radio -->
      <div class="col-sm-12">
        <p>
          <label><strong>{{$question->question}}{{$question->required ? "" : " (opcional)"}}</strong>  <br>
          <p>{{$question->observations ?  $question->observations : ""}}</p></label>
          <div class="row">
          <!--table -->
          @if($question->options_rows_number > 1 )
          	<div class="col-sm-8 col-sm-offset-4">
	          	<div class="row">
			  	@for($i=1; $i <= $question->options_columns_number; $i++)
			  		@if($i==1)
			  		<div class="col-sm-3">
			  			<span>{{$question->min_label}}</span>
			  		</div>
			  		@elseif($i==$question->options_columns_number)
			  		<div class="col-sm-3">
			  			<span>{{$question->max_label}}</span><br>
			  		</div>
			  		@else
			  		<div class="col-sm-3">
				  		@if($i==3)
			  			<span>Medianamente efectivo</span>
			  			@endif
			  			@if($i==2)
			  			<span>Poco efectivo</span>
			  			@endif
			  		</div>
			  	    @endif
			  	@endfor
	          	</div>
          	</div>
             	@foreach($question->answers as $answer)
			 	<div class="row">
                    @for($i=1; $i <= $question->options_columns_number; $i++)
                    	@if($i===1)
						<div class="col-sm-4">
                        	<span>{{$answer->answer}}</span>
                        </div>
						@endif
                     @endfor
                     <div class="col-sm-8">
                     	<div class="row">
					 	@for($i=1; $i <= $question->options_columns_number; $i++)
					 		<div class="col-sm-3">
					 			<label>{{Form::radio('question_'.$count.'_'.$question->id.'_'.$answer->id."[$i]",$i, "",['class' => 'form-control '.'question_'.$question->id.'_'.$answer->id])}}</label>
					 		</div>
					 	@endfor


                     	</div>
                     </div>
                  </div>
                  @if($errors->has('question_'.$count.'_'.$question->id.'_'.$answer->id))
                  <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id.'_'.$answer->id)}}</strong>
                  @endif
                  <div class="divider"></div>
                @endforeach
          </div>
          @else

              <ul class="inline">

                @for($i=1; $i <= $question->options_columns_number; $i++)
                <li>
                    @if($i===1)
                        <label>
                        	<span class="row">
                        		<span class="col-sm-9">{{$question->min_label}}</span>
                        		<span class="col-sm-3">{{$i}}<br>
								{{Form::radio('question_'.$count.'_'.$question->id."[$i]",$i, "",['class' => 'form-control '.'question_'.$question->id])}}
                        		</span>
                        	</span>
                        </label>
                    @elseif($i===$question->options_columns_number)
      					<label>
      						<span class="row">
                        		<span class="col-sm-3">
                        			{{$i}}<br>
									{{Form::radio('question_'.$count.'_'.$question->id."[$i]",$i, "",['class' => 'form-control '.'question_'.$question->id])}}
								</span>
								<span class="col-sm-6">
								{{$question->max_label}}
								</span>
      						</span>

      					</label>
                    @else

                        <label>
                        	<span class="row">
                        		<span class="col-sm-3">
                        		{{$i}}<br>
								{{Form::radio('question_'.$count.'_'.$question->id."[$i]",$i, "",['class' => 'form-control '.'question_'.$question->id])}}
                        		</span>
                        	</span>
                       </label>
                    @endif
                </li>
                @endfor

    					</ul>
          @endif
          @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id)}}</strong>
          @endif
        </p>
         <div class="divider"></div>
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
