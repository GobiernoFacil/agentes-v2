{!! Form::open(['url' => 'dashboard/facilitadores/crear', "class" => "form-horizontal"]) !!}
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
    <p>{{Form::submit('Crear facilitador', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
