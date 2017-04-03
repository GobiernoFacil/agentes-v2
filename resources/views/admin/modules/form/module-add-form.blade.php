{!! Form::model($module,['url' => url('dashboard/modulos/guardar').'/'.$module->id, "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de Módulo</h2>
  </div>
</div>



<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar módulo', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
