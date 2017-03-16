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
    <p>
      <label>Institución</label>
      {{Form::select('institution',[null => "Selecciona una opción", 'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales' =>'Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales', 'Gestión Social Y Cooperación'=>'Gestión Social Y Cooperación', 'Gobierno Fácil'=>'Gobierno Fácil', 'Programa de las Naciones Unidas para el Desarrollo'=>'Programa de las Naciones Unidas para el Desarrollo','PROSOCIEDAD'=>'PROSOCIEDAD'],null, ['class' => 'form-control','id'=>'state'])}}
      @if($errors->has('institution'))
      <strong>{{$errors->first('institution')}}</strong>
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
