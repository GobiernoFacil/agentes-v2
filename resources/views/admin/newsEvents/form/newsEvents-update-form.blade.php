{!! Form::model($content,['url' => url("dashboard/noticias-eventos/update/{$content->id}"), "class" => "form-horizontal",'files'=>true]) !!}
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
      {{Form::select('type',[null => "Selecciona una opción", 'news' =>'Noticia', 'event'=>'Evento','notice'=>"Aviso"],null, ['class' => 'form-control','id'=>'type'])}}
      @if($errors->has('type'))
      <strong class="danger">{{$errors->first('type')}}</strong>
      @endif
    </p>
  </div>
</div>
<!-- programa -->
<div class="row" style ="{{$errors->has('program_id') || old('program_id') || $content->type==='notice' ? '' : 'display:none;'}}" id = 'program_div'>
  <div class="col-sm-12">
    <p>
      <label><strong>Programa</strong></label>
      {{Form::select('program_id',$programs,null, ['class' => 'form-control','id'=>'program'])}}
      @if($errors->has('program_id'))
      <strong class="danger">{{$errors->first('program_id')}}</strong>
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

<!-- brief  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Breve descripción</strong> <br>
      {{Form::textarea('brief',null, ["class" => "form-control"])}} </label>
      @if($errors->has('brief'))
      <strong class="danger">{{$errors->first('brief')}}</strong>
      @endif
    </p>
  </div>
</div>

<!-- content  -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Contenido</strong> <br>
      {{Form::textarea('content',null, ["class" => "form-control",'id'=>'content'])}} </label>
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
<!-- featured image -->
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Foto</strong></label><br>
      @if($content->image)
      <img src='{{url("img/newsEvent/{$content->image->name}")}}'>
      @endif
      {{Form::file('image', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato .jpg, .png)
      @if($errors->has('image'))
      <strong class="error">{{$errors->first('image')}}</strong>
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
