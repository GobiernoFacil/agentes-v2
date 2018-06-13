@extends('layouts.admin.a_master')
@section('title', 'Respuestas de encuesta de satisfacción de ')
@section('description', 'Respuestas de encuesta de satisfacción de ' )
@section('body_class', '')
@section('breadcrumb_type', 'survey  view')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_survey')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar preguntas a encuesta  <strong>{{$quiz->title}}</strong></h1>
		<div class="divider"></div>
		<p>Instrucciones:</p>
		<ol>
			<li>Da clic en <strong>Agregar pregunta</strong> para comenzar.</li>
			<li>Escribe la pregunta y guárdala.</li>
			<li>Agrega respuesta a la pregunta y guárdala.</li>
			<li>Selecciona una respuesta como la correcta.</li>
			<li>Puedes editar preguntas y respuestas dando clic sobre ella.</li>
			<li>Puedes eliminar preguntas y respuestas dando clic en [X].</li>
			<li>Cuando estén todas las preguntas da clic en finalizar.</li>
		</ol>
	</div>
</div>
<div class="box">
    <div class="row">
    	<div class="col-sm-10 col-sm-offset-1">
        @if(Session::has('error'))
  			<div class="message error">
  		    	{{ Session::get('error') }}
  		  	</div>
  		@endif
      	</div>
        <div id="GF-PNUD-EVALUATION-APP">
			<div class="col-sm-10 col-sm-offset-1">
        	 	<h1 id="title"></h1>
        	 	<form  id = "form" role="form"  action="" >
        	 	   {{Form::hidden('quizId',$quiz->id, ["class" => "form-control","id"=>"quizInfoId"])}}
        	 	</form>
			 	<!-- lista de preguntas-->
        	 	<ol id="questions-list"></ol>
			 	<!-- agregar pregunta-->
			 	<div class="divider b"></div>
        	 	<h3><a href="#" id="add-question" class ="btn  ev">Agregar pregunta a evaluación [+]</a></h3>
        	</div>

        </div>
        <!-- finalizar-->
        <div class="col-sm-12">
        	<div class="divider"></div>
    	</div>
		<div class="col-sm-8 col-sm-offset-2 center">
				<a href='{{url("dashboard/encuestas/programa/$program->id/checkAnswers/$quiz->id")}}' class="btn gde">FINALIZAR</a>
        </div>
    </div>
</div>
@endsection

@section('js-content')
  <!-- THE CODE-->
  @include('admin.modules.quiz.question-templates')

  <script src="{{url('js/eval/jquery.js')}}"></script>
  <script src="{{url('js/eval/sortable.js')}}"></script>
  <script>
  var fakeEndpoint         = '{{url("dashboard/encuestas/programa/$program->id/save/question/$quiz->id")}}',
      saveQuestionUrl      = '{{url("dashboard/encuestas/programa/$program->id/save/question/$quiz->id")}}',
      removeQuestionUrl    = '{{url("dashboard/encuestas/programa/$program->id/remove/question/$quiz->id")}}',
      saveAnswerUrl        = '{{url("dashboard/encuestas/programa/$program->id/save/answer/$quiz->id")}}',
      removeAnswerUrl      = '{{url("dashboard/encuestas/programa/$program->id/remove/answer/$quiz->id")}}',
      switchAnswerUrl      = '{{url("dashboard/encuestas/programa/$program->id/switch/answer/$quiz->id")}}',
      getQuestionUrl       = '{{url("dashboard/encuestas/programa/$program->id/get/questions/$quiz->id")}}',
      updateQuestionUrl    = '{{url("dashboard/encuestas/programa/$program->id/update/questions/$quiz->id")}}',
      updateAnswerUrl      = '{{url("dashboard/encuestas/programa/$program->id/update/answer/$quiz->id")}}',
      token                = document.querySelector('input[name="_token"]').value;
      idQ                  = document.getElementById('quizInfoId').value;
      Questions            = <?php echo $questions; ?>;
      Answers              = <?php echo $answers; ?>;


  </script>
  <script src="{{url('js/eval/main.js')}}"></script>
@endsection
