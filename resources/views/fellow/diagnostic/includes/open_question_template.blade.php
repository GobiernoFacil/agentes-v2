<!-- answer_open -->
<div class="col-sm-12">
    <p>
      <label><strong>{{$question->question}}{{$question->required ? "*" : " (opcional)"}}</strong><br>
             <p>{{$question->observations ?  $question->observations : ""}}</p>
             {{Form::textarea('question_'.$count.'_'.$question->id,null, ["class" => "form-control"])}}
      </label>
    </p>
    <div class="divider"></div>
</div>
