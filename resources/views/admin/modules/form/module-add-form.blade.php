{!! Form::open(['url' => url("dashboard/programas/$program->id/modulos/save"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información de Módulo</h2>
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
<!-- Fechas -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha inicio</strong> <br>
      {{Form::text('start',null, ["class" => "form-control", 'id'=>'startD'])}} </label>
      @if($errors->has('start'))
      <strong class="danger">{{$errors->first('start')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha final</strong> <br>
      {{Form::text('end',null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('end'))
      <strong class="danger">{{$errors->first('end')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- horas y sesiones -->
<div class="row">
  <div class="col-sm-6">
    <p>
      <label><strong>Número de sesiones</strong> <br>
      {{Form::text('number_sessions',null, ["class" => "form-control"])}} </label>
      @if($errors->has('number_sessions'))
      <strong class="danger">{{$errors->first('number_sessions')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Total de horas</strong> <br>
      {{Form::text('number_hours', null, ["class" => "form-control",'id'=>'startE'])}} </label>
      @if($errors->has('number_hours'))
      <strong class="danger">{{$errors->first('number_hours')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- modalidad -->

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Modalidad</strong></label>
      {{Form::select('modality',[null => "Selecciona una opción", 'En línea' =>'En línea', 'Presencial'=>'Presencial'],null, ['class' => 'form-control'])}}
      @if($errors->has('modality'))
      <strong class="danger">{{$errors->first('modality')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- situación  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Situación Didáctica</strong> <br>
      {{Form::textarea('teaching_situation',null, ["class" => "form-control"])}} </label>
      @if($errors->has('teaching_situation'))
      <strong class="danger">{{$errors->first('teaching_situation')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- objectivo  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Objetivo</strong> <br>
      {{Form::textarea('objective',null, ["class" => "form-control"])}} </label>
      @if($errors->has('objective'))
      <strong class="danger">{{$errors->first('objective')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Productos a desarrollar</strong> <br>
      {{Form::textarea('product_developed',null, ["class" => "form-control"])}} </label>
      @if($errors->has('product_developed'))
      <strong class="danger">{{$errors->first('product_developed')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- modalidad -->

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Publicar</strong></label>
      {{Form::select('public',[null => "Selecciona una opción", '0' =>'No', '1'=>'Sí'],null, ['class' => 'form-control'])}}
      @if($errors->has('public'))
      <strong class="danger">{{$errors->first('public')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar módulo', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
