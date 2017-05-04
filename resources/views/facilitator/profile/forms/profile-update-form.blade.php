{!! Form::model($user,['url' => "tablero-facilitador/perfil/save", "class" => "form-horizontal", 'files'=>true]) !!}
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
      <label><strong>Correo</strong></label>
      {{Form::text('email', null, ["class" => "form-control"])}}
      @if($errors->has('email'))
      <strong class="error">{{$errors->first('email')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Institución</strong></label>
      {{Form::text('institution', null, ["class" => "form-control"])}}
      @if($errors->has('institution'))
      <strong class="error">{{$errors->first('institution')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- expert -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>¿Experto en el área?</strong></label>
      {{Form::select('expert',[null => "Selecciona una opción", '1' =>'Sí', '0'=> 'No'],$user->FacilitatorData->expert, ['class' => 'form-control'])}}
      @if($errors->has('expert'))
      <strong class="danger">{{$errors->first('expert')}}</strong>
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
  <div class="col-sm-6">
    <p>
      <label><strong>Grado de estudios</strong></label>
      {{Form::text('degree', $user->FacilitatorData->degree, ["class" => "form-control"])}}
      @if($errors->has('degree'))
      <strong class="error">{{$errors->first('degree')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Sitio Web</strong></label>
      {{Form::text('web', $user->FacilitatorData->web, ["class" => "form-control"])}}
      @if($errors->has('web'))
      <strong class="error">{{$errors->first('web')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Twitter</strong></label>
      {{Form::text('twitter', $user->FacilitatorData->twitter, ["class" => "form-control"])}}
      @if($errors->has('twitter'))
      <strong class="error">{{$errors->first('twitter')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Facebook</strong></label>
      {{Form::text('facebook', $user->FacilitatorData->facebook, ["class" => "form-control"])}}
      @if($errors->has('facebook'))
      <strong class="error">{{$errors->first('facebook')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Linkedin</strong></label>
      {{Form::text('linkedin', $user->FacilitatorData->linkedin, ["class" => "form-control"])}}
      @if($errors->has('linkedin'))
      <strong class="error">{{$errors->first('linkedin')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Otra</strong></label>
      {{Form::text('other', $user->FacilitatorData->other, ["class" => "form-control"])}}
      @if($errors->has('other'))
      <strong class="error">{{$errors->first('other')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Semblanza</strong> <br>
      {{Form::textarea('semblance',null, ["class" => "form-control"])}} </label>
      @if($errors->has('semblance'))
      <strong class="danger">{{$errors->first('semblance')}}</strong>
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
    <p>{{Form::submit('Actualizar facilitador', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
