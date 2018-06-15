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

@include('fellow.surveys.layouts.box_template')

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
<script type="text/text" id="GF-PNUD-quiz-open-template">
  <li id="<%=id%>">
    <label>
      <textarea data-question="<%=id%>"  name="open" value="<%=id%>"></textarea>
    </label>
  </li>
</script>
<script type="text/text" id="GF-PNUD-quiz-radio-template">
  <?php for($i=1; $i <= 5; $i++){ ?>
    <li id="<%=id%>">
  <?php  if($i==1){ ?>
      <label>
        <span class="row">
          <span class="col-sm-9">Menor</span>
          <span class="col-sm-3">{{$i}}<br>
              <input data-question="<%=id%>" type="radio" name="answer" value="{{$i}}" class = "GF-scale">
          </span>
        </span>
      </label>
  <?php  }else if($i ==5){ ?>
    <label>
      <span class="row">
            <span class="col-sm-3">{{$i}}<br>
                 <input data-question="<%=id%>" type="radio" name="answer" value="{{$i}}" class = "GF-scale">
            </span>
      <span class="col-sm-6">Mayor</span>
      </span>
    </label>
  <?php  }else{ ?>
    <label>
      <span class="row">
        <span class="col-sm-3">
          {{$i}}<br>
            <input data-question="<%=id%>" type="radio" name="answer" value="{{$i}}" class = "GF-scale">
        </span>
      </span>
   </label>
<?php     } ?>
    </li>
<?php   } ?>
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
            uiOpenQuestion   = document.getElementById("GF-open"),
            uiRadioQuestion  = document.getElementById("GF-scale"),
            uiMulQuestion    = document.getElementById("GF-multiple"),
		        uiAnswers        = document.getElementById("GF-PNUD-quiz-answers"),
            uiOpen           = document.getElementById("GF-PNUD-quiz-open"),
            uiRadio          = document.getElementById("GF-PNUD-quiz-radio"),
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
		        uiAnswerTemplate = document.getElementById("GF-PNUD-quiz-answer-template").innerHTML,
            uiRadioTemplate  = document.getElementById("GF-PNUD-quiz-radio-template").innerHTML,
            uiOpenTemplate   = document.getElementById("GF-PNUD-quiz-open-template").innerHTML;



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
          if(questions[question].required){
            uiQuestion.innerHTML         = questions[question].question+"<span id = 'requiredQuestion'>*</span>";
          }else{
            uiQuestion.innerHTML         = questions[question].question;
          }

          console.log(questions[question]);
          if(questions[question].type=== 'open'){
            uiOpenQuestion.style.display  = "block";
            template = _.template(uiOpenTemplate);
            uiOpen.insertAdjacentHTML('beforeend',template(questions[question]));
          }else if(questions[question].type=== 'radio'){
            uiRadioQuestion.style.display  = "block";
          }else if(questions[question].type=== 'answers'){
            var _answers = answers.filter(function(answer){
                            return answer.question_id == questions[question].id;
                          }),
           template = _.template(uiAnswerTemplate);
           console.log(template)
           _answers.forEach(function(answer){
             uiAnswers.insertAdjacentHTML('beforeend', template(answer));
           });
          }

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
          console.log(question);
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
