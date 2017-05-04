{!! Form::model($user,['url' => "sa/dashboard/perfil/save", "class" => "form-horizontal"]) !!}

<p>
  <label><strong>Nombre</strong></label>
  {{Form::text('name', null, ["class" => "form-control"])}}
  @if($errors->has('name'))
    <strong>{{$errors->first('name')}}</strong>
  @endif
</p>

<p>
  <label><strong>Correo</strong></label>
  {{Form::text('email', null, ["class" => "form-control"])}}
  @if($errors->has('email'))
    <strong>{{$errors->first('email')}}</strong>
  @endif
</p>

<p>
  <label><strong>Contraseña</strong></label>
  {{Form::password('password', ['class' => 'form-control'])}}
  @if($errors->has('password'))
    <strong>{{$errors->first('password')}}</strong>
  @endif
</p>

<p>
  <label><strong>Confirmar Contraseña</strong></label>
  {{Form::password('password-confirm', ['class' => 'form-control'])}}
  @if($errors->has('password-confirm'))
    <strong>{{$errors->first('password-confirm')}}</strong>
  @endif
</p>

<p>{{Form::submit('Actualizar Perfil', ['class' => 'btn'])}}</p>

{!! Form::close() !!}
