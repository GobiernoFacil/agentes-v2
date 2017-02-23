{!! Form::open(['url' => 'convocatoria/aplicar', "class" => "form-horizontal"]) !!}

<p>
  <label>Nombre</label>
  {{Form::text('name', null, ["class" => "form-control"])}}
  @if($errors->has('name'))
    <strong>{{$errors->first('name')}}</strong>
  @endif
</p>
<p>
  <label>Apellido Paterno</label>
  {{Form::text('surname', null, ["class" => "form-control"])}}
  @if($errors->has('surname'))
    <strong>{{$errors->first('surname')}}</strong>
  @endif
</p>
<p>
  <label>Apellido Materno</label>
  {{Form::text('lastname', null, ["class" => "form-control"])}}
  @if($errors->has('lastname'))
    <strong>{{$errors->first('lastname')}}</strong>
  @endif
</p>
<p>
  <label>Grado de estudios completados</label>
  {{Form::text('degree', null, ["class" => "form-control"])}}
  @if($errors->has('degree'))
    <strong>{{$errors->first('degree')}}</strong>
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
  <label>Confirmar correo</label>
  {{Form::text('email-confirm', null, ['class' => 'form-control'])}}
  @if($errors->has('email-confirm'))
    <strong>{{$errors->first('email-confirm')}}</strong>
  @endif
</p>

<p>
  <label>Ciudad</label>
  {{Form::text('city',null, ['class' => 'form-control'])}}
  @if($errors->has('city'))
    <strong>{{$errors->first('city')}}</strong>
  @endif
</p>

<p>
  <label>Estado</label>
  {{Form::text('state',null, ['class' => 'form-control'])}}
  @if($errors->has('state'))
    <strong>{{$errors->first('state')}}</strong>
  @endif
</p>

<p>{{Form::submit('Enviar', ['class' => 'btn'])}}</p>

{!! Form::close() !!}
