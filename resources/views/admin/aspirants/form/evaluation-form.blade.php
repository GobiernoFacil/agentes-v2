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
      {{Form::checkbox('experience','Sí', ['class' => 'form-control'])}}
      @if($errors->has('experience'))
      <strong>{{$errors->first('experience')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Confirmar Contraseña</label>
      {{Form::password('password-confirm', ['class' => 'form-control'])}}
      @if($errors->has('password-confirm'))
      <strong>{{$errors->first('password-confirm')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Crear administrador', ['class' => 'btn'])}}</p>
  </div>
</div>
{!! Form::close() !!}
