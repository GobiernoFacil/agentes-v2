{!! Form::model($activityR,['url' => url("dashboard/sesiones/actividades/requerimientos/update/$activityR->id"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del recurso</h2>
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
<!-- horas y material_link -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Número de recurso</strong> <br>
      {{Form::text('order',null, ["class" => "form-control"])}} </label>
      @if($errors->has('order'))
      <strong class="danger">{{$errors->first('order')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>URL de recurso o material</strong> <br>
      {{Form::text('material_link', null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('material_link'))
      <strong class="danger">{{$errors->first('material_link')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- descripción  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Descripción</strong> <br>
      {{Form::textarea('description',null, ["class" => "form-control"])}} </label>
      @if($errors->has('description'))
      <strong class="danger">{{$errors->first('description')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar recurso', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
