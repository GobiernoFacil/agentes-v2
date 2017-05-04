{!! Form::model($admin,['url' => "sa/dashboard/administradores/editar/{$admin->id}", "class" => "form-horizontal",'files'=>true]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong></label>
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
      <label><strong>Correo</strong></label>
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
      <label><strong>Contraseña</strong></label>
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
      <label><strong>Confirmar Contraseña</strong></label>
      {{Form::password('password-confirm', ['class' => 'form-control'])}}
      @if($errors->has('password-confirm'))
      <strong>{{$errors->first('password-confirm')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Institución</strong></label>
      {{Form::select('institution',[null => "Selecciona una opción", 'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales' =>'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales', 'Gestión Social Y Cooperación'=>'Gestión Social Y Cooperación', 'Gobierno Fácil'=>'Gobierno Fácil', 'Programa de las Naciones Unidas para el Desarrollo'=>'Programa de las Naciones Unidas para el Desarrollo','PROSOCIEDAD'=>'PROSOCIEDAD'],null, ['class' => 'form-control','id'=>'state'])}}
      @if($errors->has('institution'))
      <strong>{{$errors->first('institution')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Foto</strong></label><br>
      @if($admin->image)
      <div class="row">
        <div class="col-sm-12">
      <img src='{{url("img/users/{$admin->image->name}")}}'>
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
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar administrador', ['class' => 'btn'])}}</p>
  </div>
</div>
{!! Form::close() !!}
