{!! Form::open(['url' => url("dashboard/sesiones/save"), "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar sesión', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
