@extends('layouts.admin.a_master')
@section('title', $activity->name )
@section('description', $activity->name)
@section('body_class', 'fellow aprendizaje modulos')
@section('breadcrumb_type', 'activity view')
@section('breadcrumb', 'layouts.fellow.breadcrumb.b_modules')
@section('subnav', 1)
@section('subnav_week', 1)

@section('content')

<?php $today = date("Y-m-d");?>
<div class="row">
	<div class="col-sm-12">
		<?php switch($activity->type) {
			case "lecture":
				$type = "Lectura";
				break;
			case "video":
				$type = "Video";
				break;
			case "evaluation":
				$type = "Evaluación";
				break;
			case "diagnostic":
					$type = "Evaluación diagnóstico";
			break;
			case "final":
					$type = "Evaluación final";
			break;
			case "face":
				$type = "Presencial";
				break;
			default:
			 $type = "Lectura";
		}
		?>
		@if(Session::has('success'))
		<div class="message success">
	      {{ Session::get('success') }}
	  	</div>
	  	@endif

			@if(Session::has('error'))
			<div class="message error">
		      {{ Session::get('error') }}
		  	</div>
		  	@endif
		<!--- session name-->
		<h4>{{$session->name}}</h4>
		<!--- activity title-->
		<div class="divider b"></div>
		<h1><strong>{{$type}}:</strong> {{$activity->name}} </h1>
		<p><span class="notetime"><strong>Duración</strong>: {{$activity->duration}} {{$activity->measure == 1 ? 'hr' : 'min'}}.</span></p>
		<div class="divider"></div>

	</div>
</div>

@if($activity->type == 'video')
<!-- video -->
	@if($activity->videos)
	<div class="row">
		<div class="col-sm-12">
			<div id="ytVideo"></div>
		</div>
	</div>
	@endif
@endif





<div class="row">
	<!--descripción-->
	<div class="col-sm-12">
		<p class="ap_message_f">{{$activity->description}}</p>
	</div>

	</div>
	@if($activity->type ==='diagnostic' && $activity->diagnosticInfo)
	   @if($user->new_diagnostic($activity->diagnosticInfo->id)->count() == 0)
					<!--si es examen de diagnostico-->
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1">
								<a href='{{ url("tablero/{$activity->session->module->program->slug}/aprendizaje/diagnostico/$activity->slug/examen/responder") }}' class="btn gde">Comenzar evaluación <strong>&gt;&gt;</strong></a>
						</div>
					</div>
			@else
			<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="box blue center">
							<h2>Ya respondiste el examen</h2>
						</div>
					</div>
						<div class="col-sm-12">
								<div class="divider b"></div>
						</div>
			</div>
		 @endif
	@endif

@if($activity->type ==='evaluation' && !$activity->files && $activity->slug !='examen-diagnostico' && $activity->quizInfo)
	@if(!$score)
			@if($activity->end >= $today )
				<div class="box">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1">
								<a href='' class="btn gde" id="ev_init">Comenzar evaluación <strong>&gt;&gt;</strong></a>
						</div>
					</div>
				</div>
			@else
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="box blue center">
						<h2>El tiempo para responder el examen ha terminado</h2>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="divider b"></div>
				</div>
			</div>
			@endif
		@else
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="box blue center">
					<h2>Ya respondiste el examen</h2>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="divider b"></div>
			</div>
		</div>
		@endif
@elseif($activity->type ==='evaluation' && $activity->files && $activity->slug !='examen-diagnostico')
<div class="box">
	<div class="row">
		@if(!$files)
			@if($activity->end >= $today )
					<div class="col-sm-3 col-sm-offset-1">
							<a href='{{ url("tablero/{$activity->session->module->program->slug}/archivos/$activity->slug/agregar") }}' class="btn gde"><strong>+</strong> Subir archivo</a>
					</div>
					@else
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<div class="box blue center">
								<h2>El tiempo para subir el archivo ha terminado</h2>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="divider b"></div>
						</div>
					</div>
					@endif
		@else
		<div class="col-sm-10 col-sm-offset-1">
			<div class="box blue center">
				<h2>Ya cuentas con un archivo</h2>
			</div>
		</div>
		<div class="col-sm-12">
				<div class="divider b"></div>
			</div>
		@endif
	</div>
</div>
@endif


@if($activity->activityFiles->count() > 0)
<!--archivos-->
<div class="box">
	<div class="row">
		<div class="col-sm-12">
			@foreach ($activity->activityFiles as $file)
			<object data='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/actividades/archivos/ver-pdf/$file->id")}}' type="application/pdf" width="100%" height="600px">
				<p<a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></p>
			</object>
			<h4><a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/actividades/archivos/descargar/$file->id")}}'>{{$file->name}}</a></h4>
			<p></p>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p><a href='{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/actividades/archivos/descargar/$file->id")}}' class="btn view block sessions_l">Descargar</a></p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif

@if($activity->forum)
@include('layouts.forums.list-at-activity')
@endif


@if($activity->type === 'evaluation')
@include('fellow.evaluation.layouts.add-evaluation')
@endif


@if($activity->type == 'video')
	@if($activity->videos)
		<script>
			function getId(url) {
				var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = url.match(regExp);
				if (match && match[2].length == 11) {
					return match[2];
				}
				else {
					return 'error';
    			}
			}

			var ytId = getId('{{$activity->videos->link}}');

			document.getElementById("ytVideo").innerHTML = '<iframe width="100%" height="555" src="//www.youtube.com/embed/' + ytId + '" frameborder="0" allowfullscreen></iframe>';
		</script>
	@endif
@endif




@endsection


@section('js-content')
<script src="/js/bower_components/underscore/underscore-min.js"></script>
<script type="text/text" id="GF-PNUD-quiz-answer-template">
  <li id="<%=id%>">
    <label>
      <input data-question="<%=question_id%>" type="radio" name="answer" value="<%=id%>"><%=value%>
    </label>
  </li>
</script>
<script>
	var module     = {!! json_encode($activity->session->module->pluck('title','slug')) !!},
	    sessions   = {!! json_encode($activity->session->module->sessions->pluck('name','slug')) !!},
	    activities = [];

	    @foreach($activity->session->module->sessions as $session)
	    activities.push({!! json_encode($session->activities->pluck('name','slug')) !!});
	    @endforeach
			(function(){
		    var successClass = "success",
		        errorClass   = "error",
		        evalURL      = '{{url("tablero/{$activity->session->module->program->slug}/evaluacion/{$activity->slug}/evaluar")}}',
		        endURL       = '{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}")}}',
		        activity     = {!!$activity->quizInfo->select('title','id','description')->first()->toJson()!!},
		        questions    = {!!$activity->quizInfo->question()->select('question','id')->get()->toJson()!!},
		        answers      = [
		        @foreach($activity->quizInfo->question as $q)
		          @foreach($q->answer()->select('value','id','question_id')->get() as $a)
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
		      currentSlide += 1;
		      uiEval.style.display = "none";

		      if(currentSlide == questions.length){
		        console.log("show ui end");
		        uiEnd.style.display = "block";
		      }
		      else{
		        console.log("show ui next");
		        uiNext.style.display = "block";
		      }
		    };

		    render.showError = function(answers){
		      uiStatusBar.classList.add(errorClass);
		      uiBadResponse.style.display = "block";
		      currentSlide += 1;
		      uiEval.style.display = "none";
					uiCorrectAns.innerHTML = '';
					for (var i = 0; i < answers.length; i++) {
						var li = document.createElement("li");
					  li.appendChild(document.createTextNode(answers[i]));
					  uiCorrectAns.appendChild(li);
					}
					uiCorrectAns.style.display = "block";
		      if(currentSlide  == questions.length){
		        console.log("show ui end");
		        uiEnd.style.display = "block";
		      }
		      else{
		        console.log("show ui next");
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
		      console.log("next", currentSlide);
		      render.updatePagination(currentSlide, questions.length);

		      uiEval.style.display      = "block";
		      uiNext.style.display      = "none";

		      render.renderSlide(currentSlide);
		    });

		    uiEvalBtn.addEventListener("click", function(e){
		      e.preventDefault();
		      console.log("eval", currentSlide);
		      var selected = uiAnswers.querySelector("input[name='answer']:checked");
		      if(!selected) return;
					console.log(activity.activity_id);
					console.log(selected.getAttribute("data-question"));
					console.log(selected.value);
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
							console.log(response.correct);
		        }
		      }, "json");
		    });

		  })();

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

<script src="{{url('js/app-display-week-menu.js')}}"></script>
@endsection
