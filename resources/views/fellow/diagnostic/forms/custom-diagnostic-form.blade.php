{!! Form::open(['url' => url("tablero/diagnostico/$questionnaire->slug"), "class" => "form-horizontal"]) !!}
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
          <label><strong>{{$question->question}}</strong> <br>
            <p>{{$question->observations ?  $question->observations : ""}}</p>
          {{Form::textarea('question_'.$count.'_'.$question->id,null, ["class" => "form-control"])}} </label>
          @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$question->id)}}</strong>
          @endif
        </p>
    </div>
    @elseif($question->type ==="radio")
    <!-- answer_radio -->
      <div class="col-sm-12">
        <p>
          <label><strong>{{$question->question}}</strong> <br>
          <p>{{$question->observations ?  $question->observations : ""}}</p></label>
          <!--table -->
          @if($question->options_rows_number > 1 )
              @for($i=1; $i <= $question->options_columns_number; $i++)
                @if($i==1)
                  <span>{{$question->min_label}} {{$i}}</span>
                @elseif($i==$question->options_columns_number)
                  <span>{{$i}}{{$question->max_label}}</span><br>
                @else
                  <span>{{$i}}</span>
                @endif
              @endfor

                @foreach($question->answers as $answer)

                  <ul class="inline">
                    @for($i=1; $i <= $question->options_columns_number; $i++)
                      @if($i===1)
                        <span>{{$answer->answer}}</span>
                      @endif
                      <li><label>{{Form::radio('question_'.$count.'_'.$question->id.'_'.$answer->id."[$i]",null, "",['class' => 'form-control '.'question_'.$question->id.'_'.$answer->id])}}</label></li>
                    @endfor
                  </ul>
                @endforeach

          @else

              <ul class="inline">

                @for($i=1; $i <= $question->options_columns_number; $i++)
                  <li>
                        @if($i===1)
                        <label><span>{{$question->min_label}}</span> {{Form::radio('question_'.$count.'_'.$question->id."[$i]",null, "",['class' => 'form-control '.'question_'.$question->id])}}</label>
                        @elseif($i===$question->options_columns_number)
      						      <label> {{Form::radio('question_'.$count.'_'.$question->id."[$i]",null, "",['class' => 'form-control '.'question_'.$question->id])}}<span>{{$question->max_label}}</span></label>
                        @else
                        <label>{{Form::radio('question_'.$count.'_'.$question->id."[$i]",null, "",['class' => 'form-control '.'question_'.$question->id])}}</label>
                        @endif
                   </li>
                @endfor

    					</ul>
          @endif
          @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$question->id)}}</strong>
          @endif
        </p>
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
