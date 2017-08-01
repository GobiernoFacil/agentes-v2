@if($data)
{!! Form::model($fellow,['url' => "dashboard/evaluacion/actividad/archivo/evaluar/save/$data->id/0", "class" => "form-horizontal", 'files'=>true]) !!}
@else
{!! Form::model($fellow,['url' => "dashboard/evaluacion/actividad/archivo/evaluar/save/$fellow->id/1", "class" => "form-horizontal", 'files'=>true]) !!}
@endif

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Puntaje</strong> <br>
      {{Form::text('score',null, ["class" => "form-control"])}} </label>
      @if($errors->has('score'))
      <strong class="danger">{{$errors->first('score')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>URL</strong> <br>
      {{Form::text('url',null, ["class" => "form-control"])}} </label>
      @if($errors->has('url'))
      <strong class="danger">{{$errors->first('url')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Comentarios</strong></label><br>
      {{Form::textarea('comments', null, ["class" => "form-control"])}} </label>
      @if($errors->has('comments'))
      <strong class="error">{{$errors->first('comments')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Archivo Corregido</strong></label><br>
      {{Form::file('file_e', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato PDF, DOC,DOCX)
      @if($errors->has('file_e'))
      <strong class="error">{{$errors->first('file_e')}}</strong>
      @endif
      @if($fellow->path)
      <a href="{{ url('dashboard/evaluacion/actividad/archivo-corregido/get/' . $fellow->id) }}" class="btn xs view">Descargar</a>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
