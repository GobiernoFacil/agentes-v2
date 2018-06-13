@extends('layouts.admin.a_master')
@section('title', 'Comenzar encuesta de satisfacción')
@section('description', 'Comenzar encuesta de satisfacción')
@section('body_class', 'fellow')
@section('breadcrumb_type', 'survey welcome')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_survey')

@section('content')
<div class="box">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 center">
      <h1>{{$survey->title}}</h1>
      <p>{{$program->title}}</p>
    </div>
    <div class="col-sm-12">
      <div class="divider b"></div>
    </div>
    <div class="col-sm-12 center">
      <p><strong>Esta encuesta es anónima</strong></p>
    </div>
    <div class="col-sm-4 col-sm-offset-4 center">
      <a href='{{ url("tablero/encuestas/encuesta-satisfaccion/1") }}' class="btn gde" id="ev_init">Comenzar</a>
    </div>

  </div>
</div>

<div class="ap_modal-bg" style="display:none;" id='ev_modal'>
	<div class="box">
		<div class="row">
		  <div class="col-sm-12">
		    <?php /*
		    @include('fellow.evaluation.forms.template-form')

		      <p id="GF-PNUD-start-quiz-btn"><a href="#">El botón que inicia el cuestionario</a></p>*/ ?>

		    <div id="GF-PNUD-quiz-texmplate" style="display: none;">
		      <p class="ap_test_count">PREGUNTA
		        <span id="GF-PNUD-quiz-current-question"></span> de
		        <span id="GF-PNUD-quiz-total-questions"></span>
		      </p>

		      <h2 id="GF-PNUD-quiz-question"></h2>
		      <form>
		        <ul id="GF-PNUD-quiz-answers" class="ap_test_answers"></ul>
		      </form>

		      <div id="GF-PNUD-quiz-status-bar">
		        <p style="display: none;" id="GF-PNUD-quiz-good-response">Tu respuesta es correcta</p>
            <p style="display: none;" id="GF-PNUD-quiz-bad-response">Tu respuesta es incorrecta, respuestas correctas: </p>
            <ul style="display: none;" id="GF-PNUD-quiz-correct-answers" >
            </ul>
						<p style="display: none;" id="GF-PNUD-quiz-null-response" >Selecciona una opción</p>
		        <div class="row">
			        <div class="col-sm-2 col-sm-offset-10">
						          <p id="GF-PNUD-quiz-eval-btn"><a href="#" class="btn view block sessions_l">Continuar</a></p>
						          <p style="display: none" id="GF-PNUD-quiz-next-btn"><a class="btn view block sessions_l" href="#">Continuar</a></p>
						          <p style="display: none;" id="GF-PNUD-quiz-end-btn"><a class="btn view block sessions_l" href="{{url("tablero/{$program->slug}/encuestas/$survey->slug/finalizar")}}">Finalizar</a></p>
		        	</div>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>

@endsection
@section('js-content')
@if($survey->questions->count() > 0 )
<script src="/js/bower_components/underscore/underscore-min.js"></script>
<script type="text/text" id="GF-PNUD-quiz-answer-template">
  <li id="<%=id%>">
    <label>
      <input data-question="<%=question_id%>" type="radio" name="answer" value="<%=id%>"><%=value%>
    </label>
  </li>
</script>
<script>

			(function(){
		    var successClass  = "success",
		        errorClass    = "error",
						correctClass  = "correct",
		        evalURL       = '{{url("tablero/{$program->slug}/encuestas/{$survey->slug}/evaluar/pregunta")}}',
		        endURL        = '{{url("tablero/{$program->slug}/encuestas/")}}',
		        activity      = {!!$survey->select('title','id','description')->get()->toJson()!!},
		        questions     = {!!$fellow_questions->toJson()!!},
						all_questions = {!!$survey->questions()->select('question','id')->get()->toJson()!!},
		        answers       = [
		        @foreach($survey->questions as $q)
		          @foreach($q->answers()->select('value','id','question_id','selected')->get() as $a)
		            {!!$a->toJson()!!},
		          @endforeach
		        @endforeach
		        {}],

		        startBtn     = document.getElementById("ev_init"),
		        currentSlide = 0,
		        render       = {},
						_token       = '{{ csrf_token() }}',

		        // ui elements
		        uiStart          = document.getElementById("ev_init"),
						evModal          = document.getElementById("ev_modal"),
		        uiTemplate       = document.getElementById("GF-PNUD-quiz-texmplate"),
		        uiCurrent        = document.getElementById("GF-PNUD-quiz-current-question"),
		        uiTotal          = document.getElementById("GF-PNUD-quiz-total-questions"),
		        uiQuestion       = document.getElementById("GF-PNUD-quiz-question"),
		        uiAnswers        = document.getElementById("GF-PNUD-quiz-answers"),
		        uiStatusBar      = document.getElementById("GF-PNUD-quiz-status-bar"),
		        uiGoodResponse   = document.getElementById("GF-PNUD-quiz-good-response"),
		        uiBadResponse    = document.getElementById("GF-PNUD-quiz-bad-response"),
		        uiNext           = document.getElementById("GF-PNUD-quiz-next-btn"),
						uiNull					 = document.getElementById("GF-PNUD-quiz-null-response"),
		        uiNextBtn        = uiNext.querySelector("a"),
		        uiEval           = document.getElementById("GF-PNUD-quiz-eval-btn"),
		        uiEvalBtn        = uiEval.querySelector("a"),
		        uiEnd            = document.getElementById("GF-PNUD-quiz-end-btn"),
		        uiEndBtn         = uiEnd.querySelector("a"),
						uiCorrectAns     = document.getElementById("GF-PNUD-quiz-correct-answers"),
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

		      uiStatusBar.classList.remove(successClass);
		      uiStatusBar.classList.remove(errorClass);
		      uiBadResponse.style.display  = "none";
		      uiGoodResponse.style.display = "none";

		      uiAnswers.innerHTML          = "";
		      uiQuestion.innerHTML         = questions[question].question;

		      var _answers = answers.filter(function(answer){
		                       return answer.question_id == questions[question].id;
		                     }),
		      template = _.template(uiAnswerTemplate);

		      _answers.forEach(function(answer){
		        uiAnswers.insertAdjacentHTML('beforeend', template(answer));
		      });
		    }

		    render.showSuccess = function(){
		      uiStatusBar.classList.add(successClass);
		      uiGoodResponse.style.display = "block";
					uiNull.style.display = "none";
		      currentSlide += 1;
		      uiEval.style.display = "none";

		      if(currentSlide == questions.length){
		        uiEnd.style.display = "block";
		      }
		      else{
		        uiNext.style.display = "block";
		      }
		    };

		    render.showError = function(answers){
		      uiStatusBar.classList.add(errorClass);
		      uiBadResponse.style.display = "block";
		      currentSlide += 1;
		      uiEval.style.display = "none";
					uiNull.style.display = "none";
					uiCorrectAns.innerHTML = '';
					for (var i = 0; i < answers.length; i++) {
						var correctAnsId = document.getElementById(answers[i].id);
						correctAnsId.classList.add(correctClass);
						var li = document.createElement("li");
					  li.appendChild(document.createTextNode(answers[i].value));
					  uiCorrectAns.appendChild(li);
					}
					uiCorrectAns.style.display = "block";
		      if(currentSlide  == questions.length){
		        uiEnd.style.display = "block";
		      }else{
		        uiNext.style.display = "block";
		      }
		    };


		    // enable the button stuff
		    startBtn.addEventListener("click", function(e){
		      // hide initial stuff, begin to render
		      e.preventDefault();
					evModal.style.display = "block";
		      render.showInterface();
		      // render slide
		    });

		    uiNextBtn.addEventListener("click", function(e){
		      e.preventDefault();
					uiCorrectAns.style.display = "none";
		      render.updatePagination(currentSlide, questions.length);

		      uiEval.style.display      = "block";
		      uiNext.style.display      = "none";

		      render.renderSlide(currentSlide);
		    });

		    uiEvalBtn.addEventListener("click", function(e){
		      e.preventDefault();
					uiNull.style.display = "none";
		      var selected = uiAnswers.querySelector("input[name='answer']:checked");
		      if(!selected){
						uiNull.style.display = "block";
						return
					}
		      $.post(evalURL, {
						_token   : _token,
		        activity : activity.activity_id,
		        question : selected.getAttribute("data-question"),
		        answer   : selected.value
		      }, function(response){
		        if(response.response){
		          render.showSuccess();
		        }
		        else{
		          render.showError(response.correct);
		        }
		      }, "json");
		    });

		  })();

			$(document).ready(function() {
			  <?php $countP =1;?>
			  @foreach($survey->questions as $question)
			    <?php $count =0;?>
			    @if($question->count_correct($question->id)==1)
			      @foreach($question->answers as $answer)
			      $('.answer_q{{$countP}}').click(function(event) {
			         $('.answer_q{{$countP}}').not(this).attr('checked', false);
			         $(this).attr('checked', true);
			       });
			      <?php $count++;?>
			      @endforeach
			    @else
			      $('.delete{{$countP}}_{{$count}}').click(function(event) {
			          event.preventDefault();
			          $('.answer_q{{$countP}}').not(this).attr('checked', false);
			       });
			    @endif
			    <?php $countP++;?>
			  @endforeach
			});
</script>
@endif

@endsection
