<span class="col-sm-9">
  <h3>{{$question->question}}</h3>
  <small><strong>Respuestas: {{$question->answers_fellows->count()}}</strong></small>
  <svg width="1000" height="500" style ="padding-left:50px; padding-top:20px" id ="question_{{$question->id}}"></svg>
  <span class="col-sm-9">
    <strong>Media: <span id ="{{$question->id}}_med">{{$question->answers_fellows()->pluck('answer')->median()}}</span></strong>
  </span>
</span>
