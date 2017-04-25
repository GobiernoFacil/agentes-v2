{!! Form::model($file,['url' => "dashboard/sesiones/actividades/archivos/update/{$file->id}", "class" => "form-horizontal", 'files'=>true]) !!}
<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Nombre</strong></label>
      {{Form::text('name', null, ["class" => "form-control"])}}
      @if($errors->has('name'))
      <strong class="error">{{$errors->first('name')}}</strong>
      @endif
    </p>
  </div>
</div>


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
    <p><a href ='{{url("dashboard/sesiones/actividades/archivos/descargar/{$file->id}")}}'>Descargar archivo</a><p>
    <p>
      <label><strong>Seleccionar otro archivo</strong></label><br>
      {{Form::file('file', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato PDF, DOC,DOCX)
      @if($errors->has('file'))
      <strong class="error">{{$errors->first('file')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Actualizar Archivos', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
