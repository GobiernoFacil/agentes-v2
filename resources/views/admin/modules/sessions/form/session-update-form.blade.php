{!! Form::model($session,['url' => url("dashboard/programas/{$session->module->program->id}/modulos/{$session->module->id}/sesiones/update/$session->id"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de la sesión</h2>
  </div>
</div>
<!-- name -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong> <br>
      {{Form::text('name',null, ["class" => "form-control"])}} </label>
      @if($errors->has('name'))
      <strong class="danger">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>


<!-- Sesión predecesora -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Sesión predecesora</strong></label>
      {{Form::select('parent_id',$list,'0', ['class' => 'form-control'])}}
      @if($errors->has('parent_id'))
      <strong class="danger">{{$errors->first('parent_id')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar sesión', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
