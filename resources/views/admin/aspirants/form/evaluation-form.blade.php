{!! Form::open(['url' => url('dashboard/aspirantes/evaluar').'/'.$aspirant->id, "class" => "form-horizontal"]) !!}

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Institución</label>
      {{Form::text('institution', null, ["class" => "form-control"])}}
      @if($errors->has('institution'))
      <strong>{{$errors->first('institution')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <h1>Experiencia previa en Gobierno Abierto y Desarrollo Sostenible</h1>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>¿El aspirante acredita experiencia en proyectos, investigaciones o intervenciones relacionadas con los componentes de Gobierno Abierto (transparencia y participación)?</label>
      <label>Sí</label>
      {{Form::radio('experience[0]','1', null,['class' => 'form-control experience'])}}
      <label>No</label>
      {{Form::radio('experience[1]','0', null,['class' => 'form-control experience'])}}
      @if($errors->has('experience'))
      <strong>{{$errors->first('experience')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>En una escala de 0 a 10, donde cero es nada relevante y diez es muy relevante ¿qué tan relevante considera la experiencia del aspirante en el desarrollo de proyectos, investigaciones o intervenciones relacionadas con los componentes de Gobierno Abierto? </label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('experience1[0]','0', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[1]','1', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[2]','2', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[3]','3', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[4]','4', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[5]','5', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[6]','6', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[7]','7', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[8]','8', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[9]','9', null,['class' => 'form-control experience1'])}}
      {{Form::radio('experience1[10]','10', null,['class' => 'form-control experience1'])}}
      @if($errors->has('experience1'))
      <strong>{{$errors->first('experience1')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Justifique su respuesta</label>
      {{Form::textarea('experienceJ1', null, ["class" => "form-control"])}}
      @if($errors->has('experienceJ1'))
      <strong>{{$errors->first('experienceJ1')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>¿El aspirante acredita experiencia en proyectos, investigaciones o intervenciones relacionadas con temas relacionados con el desarrollo sostenible?</label>
      <label>Sí</label>
      {{Form::radio('experience2[0]','1', null,['class' => 'form-control experience2'])}}
      <label>No</label>
      {{Form::radio('experience2[1]','0', null,['class' => 'form-control experience2'])}}
      @if($errors->has('experience2'))
      <strong>{{$errors->first('experience2')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>En una escala de 0 a 10, donde cero es nada relevante y diez es muy relevante ¿qué tan relevante considera la experiencia del aspirante en el desarrollo de proyectos, investigaciones o intervenciones relacionadas con el desarrollo sostenible? </label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('experience3[0]','0', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[1]','1', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[2]','2', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[3]','3', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[4]','4', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[5]','5', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[6]','6', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[7]','7', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[8]','8', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[9]','9', null,['class' => 'form-control experience3'])}}
      {{Form::radio('experience3[10]','10', null,['class' => 'form-control experience3'])}}
      @if($errors->has('experience3'))
      <strong>{{$errors->first('experience3')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Justifique su respuesta</label>
      {{Form::textarea('experienceJ2', null, ["class" => "form-control"])}}
      @if($errors->has('experienceJ2'))
      <strong>{{$errors->first('experienceJ2')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <h2>Valoración de ensayo</h2>
    <p>En una escala de 0 a 10, donde 0 es nada de acuerdo y 10 es muy de acuerdo, evalúe las siguientes afirmaciones con base en el análisis del ensayo y el video enviado por el aspirante</p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante expresa con claridad las razones para participar en el programa</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('essay[0]','0', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[1]','1', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[2]','2', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[3]','3', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[4]','4', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[5]','5', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[6]','6', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[7]','7', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[8]','8', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[9]','9', null,['class' => 'form-control essay'])}}
      {{Form::radio('essay[10]','10', null,['class' => 'form-control essay'])}}
      @if($errors->has('essay'))
      <strong>{{$errors->first('essay')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante expresa con claridad las aportaciones que puede brindar a la agenda de gobierno abierto y desarrollo sostenible en su entidad</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('essay1[0]','0', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[1]','1', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[2]','2', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[3]','3', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[4]','4', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[5]','5', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[6]','6', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[7]','7', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[8]','8', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[9]','9', null,['class' => 'form-control essay1'])}}
      {{Form::radio('essay1[10]','10', null,['class' => 'form-control essay1'])}}
      @if($errors->has('essay1'))
      <strong>{{$errors->first('essay1')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante es capaz de presentar ideas y argumentos escritos de forma eficaz</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('essay2[0]','0', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[1]','1', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[2]','2', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[3]','3', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[4]','4', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[5]','5', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[6]','6', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[7]','7', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[8]','8', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[9]','9', null,['class' => 'form-control essay2'])}}
      {{Form::radio('essay2[10]','10', null,['class' => 'form-control essay2'])}}
      @if($errors->has('essay2'))
      <strong>{{$errors->first('essay2')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante muestra un conocimiento amplio de los debates actuales sobre gobierno abierto y desarrollo sostenible</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('essay3[0]','0', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[1]','1', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[2]','2', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[3]','3', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[4]','4', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[5]','5', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[6]','6', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[7]','7', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[8]','8', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[9]','9', null,['class' => 'form-control essay3'])}}
      {{Form::radio('essay3[10]','10', null,['class' => 'form-control essay3'])}}
      @if($errors->has('essay3'))
      <strong>{{$errors->first('essay3')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante muestra conocimiento y sensibilidad sobre los principales desafíos de desarrollo que enfrenta su entidad federativa</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('essay4[0]','0', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[1]','1', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[2]','2', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[3]','3', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[4]','4', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[5]','5', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[6]','6', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[7]','7', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[8]','8', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[9]','9', null,['class' => 'form-control essay4'])}}
      {{Form::radio('essay4[10]','10', null,['class' => 'form-control essay4'])}}
      @if($errors->has('essay4'))
      <strong>{{$errors->first('essay4')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <h2>Valoración de video</h2>
    <p>En una escala de 0 a 10, donde 0 es nada de acuerdo y 10 es muy de acuerdo, evalúe las siguientes afirmaciones con base en el análisis del ensayo y el video enviado por el aspirante</p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante presenta una idea de proyecto que integra adecuadamente las perspectivas de gobierno abierto y desarrollo sostenible</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('video[0]','0', null,['class' => 'form-control video'])}}
      {{Form::radio('video[1]','1', null,['class' => 'form-control video'])}}
      {{Form::radio('video[2]','2', null,['class' => 'form-control video'])}}
      {{Form::radio('video[3]','3', null,['class' => 'form-control video'])}}
      {{Form::radio('video[4]','4', null,['class' => 'form-control video'])}}
      {{Form::radio('video[5]','5', null,['class' => 'form-control video'])}}
      {{Form::radio('video[6]','6', null,['class' => 'form-control video'])}}
      {{Form::radio('video[7]','7', null,['class' => 'form-control video'])}}
      {{Form::radio('video[8]','8', null,['class' => 'form-control video'])}}
      {{Form::radio('video[9]','9', null,['class' => 'form-control video'])}}
      {{Form::radio('video[10]','10', null,['class' => 'form-control video'])}}
      @if($errors->has('video'))
      <strong>{{$errors->first('video')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>La idea desarrollada por el aspirante cuenta con el potencial de transformar una problemática relevante de su entidad federativa</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('video1[0]','0', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[1]','1', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[2]','2', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[3]','3', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[4]','4', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[5]','5', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[6]','6', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[7]','7', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[8]','8', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[9]','9', null,['class' => 'form-control video1'])}}
      {{Form::radio('video1[10]','10', null,['class' => 'form-control video1'])}}
      @if($errors->has('video1'))
      <strong>{{$errors->first('video1')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>La idea desarrollada por el aspirante es factible de ser implementada en el mediano plazo en el marco de los ejercicios locales de gobierno abierto</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {!!Form::radio('video2[1]','0', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[2]','1', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[3]','2', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[4]','3', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[5]','4', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[6]','5', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[7]','6', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[8]','7', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[9]','8', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[10]','9', null,['class' => 'form-control video2'])!!}
      {!!Form::radio('video2[11]','10', null,['class' => 'form-control video2'])!!}
      @if($errors->has('video2'))
      <strong>{{$errors->first('video2')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante explica de forma clara y con soltura su idea frente a la cámara</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('video3[0]','0', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[1]','1', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[2]','2', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[3]','3', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[4]','4', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[5]','5', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[6]','6', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[7]','7', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[8]','8', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[9]','9', null,['class' => 'form-control video3'])}}
      {{Form::radio('video3[10]','10', null,['class' => 'form-control video3'])}}
      @if($errors->has('video3'))
      <strong>{{$errors->first('video3')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante logra persuadir con respecto a la importancia y relevancia de su idea</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::radio('video4[0]','0', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[1]','1', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[2]','2', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[3]','3', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[4]','4', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[5]','5', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[6]','6', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[7]','7', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[8]','8', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[9]','9', null,['class' => 'form-control video4'])}}
      {{Form::radio('video4[10]','10', null,['class' => 'form-control video4'])}}
      @if($errors->has('video4'))
      <strong>{{$errors->first('video4')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar', ['class' => 'btn'])}}</p>
  </div>
</div>
{!! Form::close() !!}
