@if(!$custom_test)
<h2>Cuestionario diagnóstico</h2>
<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h2><a href='{{url("tablero/diagnostico/{$questionnaire->slug}")}}'>Cuestionario diagnóstico {{$questionnaire->title}}</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>Aún no has contestado este cuestionario</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/diagnostico/{$questionnaire->slug}")}}'>Ver</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
      </div>
    </div>
  </div>
	</div>
</div>
@endif

@if(!$diagnostic_2)
<h2>Cuestionario diagnóstico</h2>
<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h2><a href='{{url("tablero/diagnostico/{$questionnaire_2->slug}")}}'> {{$questionnaire_2->title}}</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>Aún no has contestado este cuestionario</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/diagnostico/{$questionnaire_2->slug}")}}'>Ver</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
      </div>
    </div>
  </div>
	</div>
</div>
@endif





@if(!$user->FellowSurvey ||($user->facilitators_survey->count()) != $fac_number)
<h2>Encuestas</h2>
@endif
@if(!$user->fellow_survey)
<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h2><a href='{{url("tablero/encuestas/encuesta-satisfaccion")}}'>Encuesta de satisfacción</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>Aún no has contestado la encuesta de satisfacción</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/encuestas/encuesta-satisfaccion")}}'>Ver encuesta</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
      </div>
    </div>
  </div>
	</div>
</div>
@endif
@if(($user->facilitators_survey->count()) != $fac_number)
<div class="box session_list">
	<div class="row">
<!--icono-->
<div class="col-sm-1 right">
  <b class="icon_h session list_s"></b>
</div>
<div class="col-sm-8">
  <h2><a href='{{url("tablero/encuestas/facilitadores-modulos")}}'>Encuesta de facilitadores</a></h2>
  <div class="divider"></div>
    <div class="row">
      <div class="col-sm-9">
        <p>Evalua de forma anónima los facilitadores del Curso 1</p>
      </div>
    </div>
  </div>
  <!-- ver sesión-->
  <div class="col-sm-3">
    <a class="btn view block sessions_l" href='{{url("tablero/encuestas/facilitadores-modulos")}}'>Ver encuesta</a>
  </div>
          <!-- footnote-->
  <div class="footnote">
    <div class="row">
      <div class="col-sm-2">
      </div>
    </div>
  </div>
	</div>
</div>
@endif
