{!! Form::model($facilitator,['url' => "dashboard/facilitadores/editar/$facilitator->id", "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Nombre</label>
      {{Form::text('name', null, ["class" => "form-control"])}}
      @if($errors->has('name'))
      <strong class="error">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Correo</label>
      {{Form::text('email', null, ["class" => "form-control"])}}
      @if($errors->has('email'))
      <strong class="error">{{$errors->first('email')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Contraseña</label>
      {{Form::password('password', ['class' => 'form-control'])}}
      @if($errors->has('password'))
      <strong class="error">{{$errors->first('password')}}</strong>
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
      <strong class="error">{{$errors->first('password-confirm')}}</strong>
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
      <strong class="error">{{$errors->first('institution')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar facilitador', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
