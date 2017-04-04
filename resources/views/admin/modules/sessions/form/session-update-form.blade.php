{!! Form::model($session,['url' => url("dashboard/sesiones/update/$session->id"), "class" => "form-horizontal"]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar sesión', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
