@extends('layouts.admin.a_master')
@section('title', 'Agregar sesión')
@section('description', 'Agregar preguntas a evaluación')
@section('body_class', '')
@section('breadcrumb_type', '')
@section('breadcrumb', '')

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <h1>Agregar preguntas a evaluación de {{$activity->name}}</h1>
    </div>
  </div>
  <div class="box">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
          <div id="GF-PNUD-EVALUATION-APP">
            <h1 id="title"></h1>
            <form  id = "form" role="form"  action="" >
              {{Form::hidden('quizId',$activity->quizInfo->id, ["class" => "form-control","id"=>"quizInfoId"])}}
              <ul id="questions-list"></ul>
              <p><a href="#" id="add-question" class ="btn xs ev">Agregar pregunta</a></p>
            </form>
          </div>
          <div class="col-sm-8 col-sm-offset-2">
           <a href='{{url("dashboard/sesiones/actividades/ver/$activity->id")}}' class="btn gde">FINALIZAR</a>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js-content')
  <!-- THE CODE-->
  @include('admin.modules.quiz.question-templates')

  <script src="{{url('js/eval/jquery.js')}}"></script>
  <script>
  var fakeEndpoint         = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/save/question")}}',
      saveQuestionUrl      = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/save/question")}}',
      removeQuestionUrl    = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/remove/question")}}',
      saveAnswerUrl        = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/save/answer")}}',
      removeAnswerUrl      = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/remove/answer")}}',
      switchAnswerUrl      = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/switch/answer")}}',
      getQuestionUrl       = '{{url("dashboard/sesiones/actividades/evaluacion/$activity->id/get/questions")}}',
      token                = document.querySelector('input[name="_token"]').value;
      idQ                  = document.getElementById('quizInfoId').value;
      Questions        = <?php echo $questions; ?>;
      Answers              = <?php echo $answers; ?>;


  </script>
  <script src="{{url('js/eval/main.js')}}"></script>
@endsection
