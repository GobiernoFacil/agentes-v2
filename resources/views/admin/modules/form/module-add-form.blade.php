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
      <strong class="danger">{{str_replace('start','fecha de inicio',$errors->first('start'))}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-6">
    <p>
      <label><strong>Fecha final</strong> <br>
      {{Form::text('end',null, ["class" => "form-control",'id'=>'startE','readonly'=>''])}} </label>
      @if($errors->has('end'))
      <strong class="danger">{{$errors->first('end')}}</strong>
      @endif
    </p>
  </div>
</div>


<!-- módulo predecesor -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Módulo predecesor</strong></label>
      {{Form::select('parent_id',$list,null, ['class' => 'form-control'])}}
      @if($errors->has('parent_id'))
      <strong class="danger">{{$errors->first('parent_id')}}</strong>
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


<!-- objetivo  -->
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



<!-- Publicar -->

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
