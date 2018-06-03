@extends('layouts.admin.a_master')
@section('title', $activity->quizInfo->title )
@section('description', 'Evaluación de'.  $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'view questions')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_quiz')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>{{$activity->quizInfo->title}}</h1>
    <p><strong>Instrucciones:</strong> Selecciona las respuestas correctas.</p>
  </div>
</div>

<div class="box">
  <div class="row">
    <div class="col-sm-12">
      <?php /*
      @include('fellow.evaluation.forms.template-form')
      */ ?>
      <p id="GF-PNUD-start-quiz-btn"><a href="#">El botón que inicia el cuestionario</a></p>

      <div id="GF-PNUD-quiz-texmplate" style="display: none;">
        <p>PREGUNTA 
          <span id="GF-PNUD-quiz-current-question"></span> de 
          <span id="GF-PNUD-quiz-total-questions"></span>
        </p>

        <h3 id="GF-PNUD-quiz-question"></h3>
        <form>
          <ul id="GF-PNUD-quiz-answers"></ul>
        </form>

        <div id="GF-PNUD-quiz-status-bar">
          <p style="display: none;" id="GF-PNUD-quiz-good-response">Tu respuesta es correcta</p>
          <p style="display: none;" id="GF-PNUD-quiz-bad-response">Tu respuesta es incorrecta</p>
          <p id="GF-PNUD-quiz-eval-btn"><a href="#">Continuar</a></p>
          <p style="display: none" id="GF-PNUD-quiz-next-btn"><a href="#">Continuar</a></p>
          <p style="display: none;" id="GF-PNUD-quiz-end-btn"><a href="#">Finalizar</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js-content')






<!-- desmadrito del cuestionario aquí: -->


<script src="/js/bower_components/underscore/underscore-min.js"></script>
<script type="text/text" id="GF-PNUD-quiz-answer-template">
  <li id="<%=id%>"><label><input type="radio" name="answer"><%=value%></label></li>
</script>
<script>
  (function(){
    var activity  = {!!$activity->quizInfo->toJson()!!},
        questions = {!!$activity->quizInfo->question->toJson()!!},
        answers   = [
        @foreach($activity->quizInfo->question as $q)
          @foreach($q->answer as $a)
            {!!$a->toJson()!!},
          @endforeach
        @endforeach
        {}],

        startBtn = document.getElementById("GF-PNUD-start-quiz-btn"),
        currentSlide = 0,
        render = {},

        // ui elements
        uiStart        = document.getElementById("GF-PNUD-start-quiz-btn"),
        uiTemplate     = document.getElementById("GF-PNUD-quiz-texmplate"),
        uiCurrent      = document.getElementById("GF-PNUD-quiz-current-question"),
        uiTotal        = document.getElementById("GF-PNUD-quiz-total-questions"),
        uiQuestion     = document.getElementById("GF-PNUD-quiz-question"),
        uiAnswers      = document.getElementById("GF-PNUD-quiz-answers"),
        uiStatusBar    = document.getElementById("GF-PNUD-quiz-status-bar"),
        uiGoodResponse = document.getElementById("GF-PNUD-quiz-good-response"),
        uiBadResponse  = document.getElementById("GF-PNUD-quiz-bad-response"),
        uiNext         = document.getElementById("GF-PNUD-quiz-next-btn"),
        uiNextBtn      = uiNext.querySelector("a"),
        uiEval         = document.getElementById("GF-PNUD-quiz-eval-btn"),
        uiEvalBtn      = uiEval.querySelector("a"),
        uiEnd          = document.getElementById("GF-PNUD-quiz-end-btn"),
        uiEndBtn       = uiEnd.querySelector("a"),
        uiAnswerTemplate = document.getElementById("GF-PNUD-quiz-answer-template").innerHTML;

    

    render.showInterface = function(){
      uiStart.style.display    = "none";
      uiTemplate.style.display = "block";
      render.updatePagination(currentSlide, questions.length);
      render.renderSlide(currentSlide);
    };

    render.updatePagination = function(current, pages){
      uiCurrent.innerHTML = current + 1;
      uiTotal.innerHTML = pages;
    }

    render.renderSlide = function(question){
      uiQuestion.innerHTML = questions[question].question;

      var _answers = answers.filter(function(answer){
                       return answer.question_id == questions[question].id;
                     }),
      template = _.template(uiAnswerTemplate);

      _answers.forEach(function(answer){
        console.log(answers, _answers, answer);
        uiAnswers.insertAdjacentHTML('beforeend', template(answer));
      });
    }

    console.log(activity, questions, answers);

    // enable the button stuff
    startBtn.addEventListener("click", function(e){
      // hide initial stuff, begin to render
      e.preventDefault();
      render.showInterface();
      // render slide
    });

  })();
</script>

<!-- termina el desmadrito del cuestionario -->



















<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
  <?php $countP =1;?>
  @foreach($activity->quizInfo->question as $question)
    <?php $count =0;?>
    @if($question->count_correct($question->id)==1)
      @foreach($question->answer as $answer)
      $('.answer_q{{$countP}}').click(function(event) {
         $('.answer_q{{$countP}}').not(this).attr('checked', false);
         $(this).attr('checked', true);
       });
      <?php $count++;?>
      @endforeach
    @else
    console.log("delete");
      $('.delete{{$countP}}_{{$count}}').click(function(event) {
          event.preventDefault();
          console.log('this');
          $('.answer_q{{$countP}}').not(this).attr('checked', false);
       });
    @endif
    <?php $countP++;?>
  @endforeach
});
</script>
@endsection
