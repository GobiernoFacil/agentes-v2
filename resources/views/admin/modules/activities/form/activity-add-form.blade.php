{!! Form::open(['url' => url("dashboard/sesiones/actividades/save/$session->id"), "class" => "form-horizontal"]) !!}
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
<!-- evaluation
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>¿Actividad para evaluar?</strong></label>
      {{Form::select('evaluation',[null => "Selecciona una opción", 'Sí' =>'Sí', 'No'=> 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('evaluation'))
      <strong class="danger">{{$errors->first('evaluation')}}</strong>
      @endif
    </p>
  </div>
</div>
-->

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tipo de Actividad</strong></label>
      {{Form::select('type',[null => "Selecciona una opción", 'lecture' =>'Lectura', 'video'=> 'Video','webinar'=>'Webinar','evaluation'=>'Evaluación','face'=>'Presencial'],null, ['class' => 'form-control', 'id'=>'type'])}}
      @if($errors->has('type'))
      <strong class="danger">{{$errors->first('type')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- files -->
<div class="row" id ="user-file" style ="{{$errors->has('files') ? $errors->first('files') ? '' :'display:none;' : 'display:none;'}}">
  <div class="col-sm-12">
    <p>
      <label><strong>¿El usuario contará con carga de archivos?</strong></label>
      {{Form::select('files',[null => "Selecciona una opción", 'Sí' =>'Sí', 'No'=> 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('files'))
      <strong class="danger">{{$errors->first('files')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- cierre -->
<div class="row" id ="end-file" style ="{{$errors->has('end') ? $errors->first('end') ? '' :'display:none;' : 'display:none;'}}">
<div class="col-sm-12">
  <p>
    <label><strong>Fecha de cierre</strong> <br>
    {{Form::text('end',null, ["class" => "form-control",'id'=>'startE'])}} </label>
    @if($errors->has('end'))
    <strong class="danger">{{$errors->first('end')}}</strong>
    @endif
  </p>
</div>
</div>
<!-- upload -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>¿Esta actividad cuenta con archivos?</strong></label>
      {{Form::select('hasfiles',[null => "Selecciona una opción", 'Sí' =>'Sí', 'No'=> 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('hasfiles'))
      <strong class="danger">{{$errors->first('hasfiles')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- forum -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>¿Esta actividad cuenta con foro?</strong></label>
      {{Form::select('hasforum',[null => "Selecciona una opción", 'Sí' =>'Sí', 'No'=> 'No'],null, ['class' => 'form-control'])}}
      @if($errors->has('hasforum'))
      <strong class="danger">{{$errors->first('hasforum')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- horas y # sesión -->
<div class="row">
  <div class="col-sm-4">
    <p>
      <label><strong>Número de actividad</strong> <br>
      {{Form::text('order',null, ["class" => "form-control"])}} </label>
      @if($errors->has('order'))
      <strong class="danger">{{$errors->first('order')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-4">
    <p>
      <label><strong>Duración</strong> <br>
      {{Form::text('duration', null, ["class" => "form-control"])}} </label>
      @if($errors->has('duration'))
      <strong class="danger">{{$errors->first('duration')}}</strong>
      @endif
    </p>
  </div>
  <div class="col-sm-4">
    <p>
      <label><strong>Unidad de medida</strong> <br>
      {{Form::select('measure',[null=>"Selecciona una opción",0=>"Minutos",1 =>"Horas"], null, ["class" => "form-control"])}} </label>
      @if($errors->has('measure'))
      <strong class="danger">{{$errors->first('measure')}}</strong>
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




<div id="webinar" style="{{old('type') ==='webinar' ? '' : 'display:none;'}}">
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del Webinar </h2>
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
      <label><strong>Hora</strong> <br>
      {{Form::text('time',null, ["class" => "form-control"])}} </label>
      @if($errors->has('time'))
      <strong class="danger">{{$errors->first('time')}}</strong>
      @endif
    </p>
  </div>
</div>

<div class="row" >
  <div class="col-sm-12">
    <p>
      <label><strong>Link</strong> <br>
      {{Form::text('link',null, ["class" => "form-control"])}} </label>
      @if($errors->has('link'))
      <strong class="danger">{{$errors->first('link')}}</strong>
      @endif
    </p>
  </div>
</div>
</div>




<div id="video" style="{{old('type') ==='video' ? '' : 'display:none;'}}">
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información del Video </h2>
  </div>
</div>

<div class="row" >
  <div class="col-sm-12">
    <p>
      <label><strong>Link</strong> <br>
      {{Form::text('link_video',null, ["class" => "form-control"])}} </label>
      @if($errors->has('link_video'))
      <strong class="danger">{{$errors->first('link_video')}}</strong>
      @endif
    </p>
  </div>
</div>
</div>



<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar actividad', ['class' => 'btn gde'])}}</p>
  </div>
</div>



{!! Form::close() !!}
