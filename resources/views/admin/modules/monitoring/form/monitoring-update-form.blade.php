{!! Form::model($monitoring,['url' => url("dashboard/sesiones/mecanismos-monitoreo/update/{$monitoring->session->id}"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de mecanismo de Monitoreo y Evaluación</h2>
  </div>
</div>
<!-- Conocimientos -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Conocimiento</strong> <br>
      {{Form::text('knowledge',null, ["class" => "form-control"])}} </label>
      @if($errors->has('knowledge'))
      <strong class="danger">{{$errors->first('knowledge')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- competitions -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Competencia</strong> <br>
      {{Form::text('competitions',null, ["class" => "form-control"])}} </label>
      @if($errors->has('competitions'))
      <strong class="danger">{{$errors->first('competitions')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- attitude -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Actitud</strong> <br>
      {{Form::text('attitude',null, ["class" => "form-control"])}} </label>
      @if($errors->has('attitude'))
      <strong class="danger">{{$errors->first('attitude')}}</strong>
      @endif
    </p>
  </div>
</div>


<!-- situación  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Rol del Mentor</strong> <br>
      {{Form::textarea('role',null, ["class" => "form-control"])}} </label>
      @if($errors->has('role'))
      <strong class="danger">{{$errors->first('role')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar mecanismo', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
