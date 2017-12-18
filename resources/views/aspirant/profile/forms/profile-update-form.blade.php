{!! Form::model($user,['url' => "tablero-aspirante/perfil/save", "class" => "form-horizontal", 'files'=>true]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre (s)</strong></label>
      {{Form::text('name', null, ["class" => "form-control"])}}
      @if($errors->has('name'))
      <strong class="error">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Contraseña</strong></label>
      {{Form::password('password', ['class' => 'form-control'])}}
      @if($errors->has('password'))
      <strong class="error">{{$errors->first('password')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Confirmar Contraseña</strong></label>
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
      <label><strong>Grado de estudios</strong></label>
      {{Form::text('degree', $user->aspirant($user)->degree, ["class" => "form-control"])}}
      @if($errors->has('degree'))
      <strong class="error">{{$errors->first('degree')}}</strong>
      @endif
    </p>
  </div>
</div>


<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Foto</strong></label><br>
      @if($user->image)
      <img src='{{url("img/users/{$user->image->name}")}}'>
      @endif
      {{Form::file('image', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .jpg, .png)
      @if($errors->has('image'))
      <strong class="error">{{$errors->first('image')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
