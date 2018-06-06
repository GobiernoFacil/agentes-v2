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
				<div class="box">
					<div class="row">
						<div class="col-sm-3 col-sm-offset-1">
								<a href='' class="btn gde" id="ev_init">Comenzar evaluación <strong>&gt;&gt;</strong></a>
						</div>
					</div>
				</div>
		@else
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="center ap_udidit">
										<h1>Ya respondiste el examen</h1>

					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 237 237" style="enable-background:new 0 0 237 237;" xml:space="preserve">

<g>
	<path class="st0" d="M118.5,0.4c-65.1,0-118,52.9-118,118c0,65.1,52.9,118,118,118c65.1,0,118-52.9,118-118
		C236.5,53.3,183.5,0.4,118.5,0.4L118.5,0.4z M118.5,223.6c-28.9,0-55.1-11.7-74.2-30.6c-7.6-7.6-14.1-16.3-19.1-25.8
		c-7.7-14.6-12-31.2-12-48.7c0-58,47.2-105.2,105.2-105.2c27.5,0,52.6,10.6,71.4,28c9.7,9,17.8,19.8,23.6,31.9
		c6.6,13.7,10.3,29.1,10.3,45.4C223.7,176.4,176.5,223.6,118.5,223.6L118.5,223.6z M118.5,223.6"/>
	<path class="st0" d="M78.1,91.6c6.9,0,12.4,5.3,12.4,12.4h12.8c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C65.7,96.9,71.3,91.6,78.1,91.6L78.1,91.6z M78.1,91.6"/>
	<path class="st0" d="M158.8,91.6c6.9,0,12.4,5.3,12.4,12.4H184c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C146.4,96.9,151.9,91.6,158.8,91.6L158.8,91.6z M158.8,91.6"/>
	<path class="st0" d="M118.2,183.8c24.7,0,48.3-12.6,61.9-33.6l-10.7-6.9c-12.4,19.2-35.2,30-58,27.4c-17.7-2-34.2-12.3-43.9-27.4
		l-10.7,6.9c11.8,18.3,31.7,30.6,53.2,33.1C112.7,183.6,115.5,183.8,118.2,183.8L118.2,183.8z M118.2,183.8"/>
</g>
<g>
	<path class="st0" d="M118.5,0.4c-65.1,0-118,52.9-118,118c0,65.1,52.9,118,118,118c65.1,0,118-52.9,118-118
		C236.5,53.3,183.5,0.4,118.5,0.4L118.5,0.4z M118.5,223.6c-28.9,0-55.1-11.7-74.2-30.6c-7.6-7.6-14.1-16.3-19.1-25.8
		c-7.7-14.6-12-31.2-12-48.7c0-58,47.2-105.2,105.2-105.2c27.5,0,52.6,10.6,71.4,28c9.7,9,17.8,19.8,23.6,31.9
		c6.6,13.7,10.3,29.1,10.3,45.4C223.7,176.4,176.5,223.6,118.5,223.6L118.5,223.6z M118.5,223.6"/>
	<path class="st0" d="M78.1,91.6c6.9,0,12.4,5.3,12.4,12.4h12.8c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C65.7,96.9,71.3,91.6,78.1,91.6L78.1,91.6z M78.1,91.6"/>
	<path class="st0" d="M158.8,91.6c6.9,0,12.4,5.3,12.4,12.4H184c0-14.3-11.3-25.2-25.2-25.2c-13.9,0-25.2,10.8-25.2,25.2h12.8
		C146.4,96.9,151.9,91.6,158.8,91.6L158.8,91.6z M158.8,91.6"/>
	<path class="st0" d="M118.2,183.8c24.7,0,48.3-12.6,61.9-33.6l-10.7-6.9c-12.4,19.2-35.2,30-58,27.4c-17.7-2-34.2-12.3-43.9-27.4
		l-10.7,6.9c11.8,18.3,31.7,30.6,53.2,33.1C112.7,183.6,115.5,183.8,118.2,183.8L118.2,183.8z M118.2,183.8"/>
</g>
</svg>
						<h3>Puntaje total: </h3>
		<h2>{{$score->score > 0 ? number_format($score->score,2)*10 . '/100' : '0/0'  }}</h2>
				</div>
			</div>
		</div>
	
		@endif
@elseif($activity->type ==='evaluation' && $activity->files && $activity->slug !='examen-diagnostico')
<div class="box">
	<div class="row">
		@if(!$files)
					<div class="col-sm-3 col-sm-offset-1">
							<a href='{{ url("tablero/{$activity->session->module->program->slug}/archivos/$activity->slug/agregar") }}' class="btn gde"><strong>+</strong> Subir archivo</a>
					</div>
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
@if($activity->type ==='evaluation' && !$score)
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
		    var successClass  = "success",
		        errorClass    = "error",
						correctClass  = "correct",
		        evalURL       = '{{url("tablero/{$activity->session->module->program->slug}/evaluacion/{$activity->slug}/evaluar")}}',
		        endURL        = '{{url("tablero/{$activity->session->module->program->slug}/aprendizaje/{$activity->session->module->slug}/{$activity->session->slug}/{$activity->slug}")}}',
		        activity      = {!!$activity->quizInfo->select('title','id','description')->first()->toJson()!!},
		        questions     = {!!$fellow_questions->toJson()!!},
						all_questions = {!!$activity->quizInfo->question()->select('question','id')->get()->toJson()!!},
		        answers       = [
		        @foreach($activity->quizInfo->question as $q)
		          @foreach($q->answer()->select('value','id','question_id','selected')->get() as $a)
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
			          $('.answer_q{{$countP}}').not(this).attr('checked', false);
			       });
			    @endif
			    <?php $countP++;?>
			  @endforeach
			});
</script>
@endif

<script src="{{url('js/app-display-week-menu.js')}}"></script>
@endsection
