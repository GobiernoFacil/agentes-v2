{!! Form::model($activity,['url' => url("dashboard/sesiones/actividades/update/$activity->id"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de la actividad</h2>
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
<!-- horas y # sesión -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Número de activdad</strong> <br>
      {{Form::text('order',null, ["class" => "form-control"])}} </label>
      @if($errors->has('order'))
      <strong class="danger">{{$errors->first('order')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Duración</strong> <br>
      {{Form::text('duration', null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('duration'))
      <strong class="danger">{{$errors->first('duration')}}</strong>
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
<!-- rol facilitador  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Rol del Facilitador</strong> <br>
      {{Form::textarea('facilitator_role',null, ["class" => "form-control"])}} </label>
      @if($errors->has('facilitator_role'))
      <strong class="danger">{{$errors->first('facilitator_role')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- rol facilitador  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Rol Participantes</strong> <br>
      {{Form::textarea('competitor_role',null, ["class" => "form-control"])}} </label>
      @if($errors->has('competitor_role'))
      <strong class="danger">{{$errors->first('competitor_role')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar actividad', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
