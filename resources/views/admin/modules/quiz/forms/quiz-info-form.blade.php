{!! Form::open(['url' => url("dashboard/sesiones/actividades/evaluacion/save/{$activity->id}/1"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información general de la evaluación</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong> <br>
      {{Form::text('title',null, ["class" => "form-control"])}} </label>
      @if($errors->has('title'))
      <strong class="danger">{{$errors->first('title')}}</strong>
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
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
