{!! Form::open(['url' => '', "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Evaluador</label>
      {{Form::text('evaluator', null, ["class" => "form-control"])}}
      @if($errors->has('evaluator'))
      <strong>{{$errors->first('evaluator')}}</strong>
      @endif
    </p>
  </div>
</div>
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
      {{Form::checkbox('experience[]','1', null,['class' => 'form-control'])}}
      <label>No</label>
      {{Form::checkbox('experience[]','0', null,['class' => 'form-control'])}}
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
      {{Form::checkbox('relevant[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('relevant[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Justifique su respuesta</label>
      {{Form::textarea('justification', null, ["class" => "form-control"])}}
      @if($errors->has('justification'))
      <strong>{{$errors->first('justification')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>¿El aspirante acredita experiencia en proyectos, investigaciones o intervenciones relacionadas con temas relacionados con el desarrollo sostenible?</label>
      <label>Sí</label>
      {{Form::checkbox('acredita[]','1', null,['class' => 'form-control'])}}
      <label>No</label>
      {{Form::checkbox('acredita[]','0', null,['class' => 'form-control'])}}
      @if($errors->has('acredita'))
      <strong>{{$errors->first('acredita')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>En una escala de 0 a 10, donde cero es nada relevante y diez es muy relevante ¿qué tan relevante considera la experiencia del aspirante en el desarrollo de proyectos, investigaciones o intervenciones relacionadas con el desarrollo sostenible? </label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('experience2'))
      <strong>{{$errors->first('experience2')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Justifique su respuesta</label>
      {{Form::textarea('justification', null, ["class" => "form-control"])}}
      @if($errors->has('justification'))
      <strong>{{$errors->first('justification')}}</strong>
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
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante expresa con claridad las aportaciones que puede brindar a la agenda de gobierno abierto y desarrollo sostenible en su entidad</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante es capaz de presentar ideas y argumentos escritos de forma eficaz</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante muestra un conocimiento amplio de los debates actuales sobre gobierno abierto y desarrollo sostenible</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante muestra conocimiento y sensibilidad sobre los principales desafíos de desarrollo que enfrenta su entidad federativa</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
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
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>La idea desarrollada por el aspirante cuenta con el potencial de transformar una problemática relevante de su entidad federativa</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>La idea desarrollada por el aspirante es factible de ser implementada en el mediano plazo en el marco de los ejercicios locales de gobierno abierto</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante explica de forma clara y con soltura su idea frente a la cámara</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label>El aspirante logra persuadir con respecto a la importancia y relevancia de su idea</label>
      <label>0 1 2 3 4 5 6 7 8 9 10</label>
      {{Form::checkbox('experience2[]','0', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','1', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','2', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','3', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','4', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','5', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','6', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','7', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','8', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','9', null,['class' => 'form-control'])}}
      {{Form::checkbox('experience2[]','10', null,['class' => 'form-control'])}}
      @if($errors->has('relevant'))
      <strong>{{$errors->first('relevant')}}</strong>
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
