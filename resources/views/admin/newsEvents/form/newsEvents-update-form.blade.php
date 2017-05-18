{!! Form::model($content,['url' => url("dashboard/noticias-eventos/update/{$content->id}"), "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Información general</h2>
  </div>
</div>
<!-- title -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Título</strong> <br>
      {{Form::text('title',null, ["class" => "form-control"])}} </label>
      @if($errors->has('title'))
      <strong class="danger">{{$errors->first('title')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- tipo -->

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Tipo</strong></label>
      {{Form::select('type',[null => "Selecciona una opción", 'news' =>'Noticia', 'event'=>'Evento'],null, ['class' => 'form-control','id'=>'type'])}}
      @if($errors->has('type'))
      <strong class="danger">{{$errors->first('type')}}</strong>
      @endif
    </p>
  </div>
</div>

<div id ="eventData" style='{{$content->type==="event" ? "" : "display:none;"}}'>
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
<!-- time  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Hora</strong> <br>
      {{Form::text('time',null, ["class" => "form-control"])}} </label>
      @if($errors->has('time'))
      <strong class="danger">{{$errors->first('time')}}</strong>
      @endif
    </p>
  </div>
</div>
</div>
<!-- content  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Contenido</strong> <br>
      {{Form::textarea('content',null, ["class" => "form-control"])}} </label>
      @if($errors->has('content'))
      <strong class="danger">{{$errors->first('content')}}</strong>
      @endif
    </p>
  </div>
</div>


<!-- public -->

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
    <p>{{Form::submit('Actualizar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
