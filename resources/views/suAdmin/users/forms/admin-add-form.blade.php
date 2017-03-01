{!! Form::open(['url' => 'sa/dashboard/administradores/crear', "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label>Nombre</label>
      {{Form::text('name', null, ["class" => "form-control"])}}
      @if($errors->has('name'))
      <strong>{{$errors->first('name')}}</strong>
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
      <strong>{{$errors->first('email')}}</strong>
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
      <strong>{{$errors->first('password')}}</strong>
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
