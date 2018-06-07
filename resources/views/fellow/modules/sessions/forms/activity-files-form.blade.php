{!! Form::open(['url' => "tablero/{$activity->session->model->program->slug}/archivos/{$activity->slug}/save", "class" => "form-horizontal", 'files'=>true]) !!}

<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Archivo</strong></label><br>
      {{Form::file('file_e', ['class' => ''])}} (documento no mayor a 10 Mb, formato PDF, DOC,DOCX)
      @if($errors->has('file_e'))
      <strong class="error">{{$errors->first('file_e')}}</strong>
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
