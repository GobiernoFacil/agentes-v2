{!! Form::open(['url' => url("tablero/{$activity->session->module->program->slug}/aprendizaje/diagnostico/$activity->slug/examen/responder"), "class" => "form-horizontal"]) !!}
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
      @include('fellow.diagnostic.includes.radio_question_template')
    @elseif($question->type === "answers")
      @include('fellow.diagnostic.includes.answers_question_template')
    @endif
    <div class="col-sm-12">
      @if($errors->has('question_'.$count.'_'.$question->id))
        <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id)}}</strong>
      @endif
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
