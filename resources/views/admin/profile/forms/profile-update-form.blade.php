{!! Form::model($user,['url' => "dashboard/perfil/save", "class" => "form-horizontal"]) !!}

<p>
  <label>Nombre</label>
  {{Form::text('name', null, ["class" => "form-control"])}}
  @if($errors->has('name'))
    <strong>{{$errors->first('name')}}</strong>
  @endif
</p>

<p>
  <label>Correo</label>
  {{Form::text('email', null, ["class" => "form-control"])}}
  @if($errors->has('email'))
    <strong>{{$errors->first('email')}}</strong>
  @endif
</p>

<p>
  <label>Contraseña</label>
  {{Form::password('password', ['class' => 'form-control'])}}
  @if($errors->has('password'))
    <strong>{{$errors->first('password')}}</strong>
  @endif
</p>

<p>
  <label>Confirmar Contraseña</label>
  {{Form::password('password-confirm', ['class' => 'form-control'])}}
  @if($errors->has('password-confirm'))
    <strong>{{$errors->first('password-confirm')}}</strong>
  @endif
</p>

<p>{{Form::submit('Actualizar Perfil', ['class' => 'btn'])}}</p>

{!! Form::close() !!}
