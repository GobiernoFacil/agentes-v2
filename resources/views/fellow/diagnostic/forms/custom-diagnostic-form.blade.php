{!! Form::open(['url' => url("tablero/diagnostico/$questionnaire->slug"), "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">{{$questionnaire->title}}</h2>
  </div>
</div>

<?php $count = 1; ?>
<ol>
  @foreach($questionnaire->questions as $question)
  <li class="row">
    <!-- answer_1 -->
      <div class="col-sm-12">
        <p>
          <label><strong>{{$question->question}}</strong> <br>
          {{Form::textarea('question_'.$count.'_'.$question->id,null, ["class" => "form-control"])}} </label>
          @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id)}}</strong>
          @endif
        </p>
    </div>
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
