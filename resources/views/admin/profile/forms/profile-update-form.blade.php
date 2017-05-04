{!! Form::model($user,['url' => "dashboard/perfil/save", "class" => "form-horizontal",'files'=>true]) !!}

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

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Foto</strong></label><br>
      @if($user->image)
      <div class="row">
        <div class="col-sm-12">
      <img src='{{url("img/users/{$user->image->name}")}}'>
    </div>
  </div>
      @endif
      {{Form::file('image', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .jpg, .png)
      @if($errors->has('image'))
      <strong class="error">{{$errors->first('image')}}</strong>
      @endif
    </p>
  </div>
</div>
<p>{{Form::submit('Actualizar Perfil', ['class' => 'btn'])}}</p>

{!! Form::close() !!}
