<!-- answer_open -->
<div class="col-sm-12">
    <p>
      <label><strong>{{$question->question}}{{$question->required ? "" : " (opcional)"}}</strong><br>
             <p>{{$question->observations ?  $question->observations : ""}}</p>
             {{Form::textarea('question_'.$count.'_'.$question->id,null, ["class" => "form-control"])}}
      </label>
      @if($errors->has('question_'.$count.'_'.$question->id))
          <strong class="danger">{{$errors->first('question_'.$count.'_'.$question->id)}}</strong>
      @endif
    </p>
    <div class="divider"></div>
</div>
