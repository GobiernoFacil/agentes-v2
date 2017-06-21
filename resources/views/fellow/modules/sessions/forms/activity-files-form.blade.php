{!! Form::open(['url' => "tablero/archivos/{$activity->slug}/save", "class" => "form-horizontal", 'files'=>true]) !!}

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Archivo</strong></label><br>
      {{Form::file('file', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato PDF, DOC,DOCX)
      @if($errors->has('file'))
      <strong class="error">{{$errors->first('file')}}</strong>
      @endif
    </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar Archivos', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
