@extends('layouts.admin.a_master')
@section('title', 'Agregar preguntas a evaluación diagnóstico')
@section('description', 'Agregar preguntas a evaluación diagnóstico')
@section('body_class', 'modulos')
@section('breadcrumb_type', 'add questions')
@section('breadcrumb', 'layouts.admin.breadcrumb.b_quiz')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h1>Agregar preguntas a evaluación diagnóstico de <strong>{{$activity->name}}</strong></h1>
		<div class="divider"></div>
		<p>Instrucciones:</p>
		<ol>
			<li>Da clic en <strong>Agregar pregunta</strong> para comenzar.</li>
			<li>Selecciona el tipo de pregunta, escribe la pregunta y guárdala.</li>
			<li>Agrega respuesta a la pregunta, si es el caso, y guárdala.</li>
			<li>Si se cuenta con respuestas, selecciona una o varias como correctas si es necesario.</li>
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
        	 	   {{Form::hidden('quizId',$activity->diagnosticInfo->id, ["class" => "form-control","id"=>"quizInfoId"])}}
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
				<a href='{{url("dashboard/sesiones/actividades/diagnostico/checkAnswers/{$activity->diagnosticInfo->id}/{$activity->id}")}}' class="btn gde">FINALIZAR</a>
        </div>
    </div>
</div>
@endsection

@section('js-content')
  <!-- THE CODE-->
  @include('admin.modules.diagnostic.question-templates')

  <script src="{{url('js/eval/jquery.js')}}"></script>
  <script src="{{url('js/eval/sortable.js')}}"></script>
  <script>
  var fakeEndpoint         = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/save/question")}}',
      saveQuestionUrl      = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/save/question")}}',
      removeQuestionUrl    = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/remove/question")}}',
      saveAnswerUrl        = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/save/answer")}}',
      removeAnswerUrl      = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/remove/answer")}}',
      switchAnswerUrl      = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/switch/answer")}}',
			switchRequiredUrl    = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/switch/required")}}',
      getQuestionUrl       = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/get/questions")}}',
      updateQuestionUrl    = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/update/questions")}}',
      updateAnswerUrl      = '{{url("dashboard/sesiones/actividades/diagnostico/$activity->id/update/answer")}}',
      token                = document.querySelector('input[name="_token"]').value;
      idQ                  = document.getElementById('quizInfoId').value;
      Questions      			 = <?php echo $questions; ?>;
      Answers              = <?php echo $answers; ?>;


  </script>
  <script src="{{url('js/eval/diagnostic.js')}}"></script>
@endsection
