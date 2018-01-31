{!! Form::model($file,['url' => url('dashboard/convocatorias/archivos/editar/'.$file->id),'files'=>true]) !!}
<!--comments-->
<div class="row">
  <div class="col-sm-12">
   <p>
     <label><strong>Descripción</strong></label>
     {{Form::textarea('comments',null, ['class' => 'form-control'])}}
     @if($errors->has('comments'))
     <strong class="danger">{{$errors->first('comments')}}</strong>
     @endif
   </p>
 </div>
</div>
<!--files-->
<div class="row">
  <div class="col-sm-12">
   <p>
     <label><strong>Archivo</strong></label>
     <p>Selecciona un archivo (DOC, DOCX o PDF), el tamaño máximo es de 2.5 MB.</p>
     <input type="file" class="form-control" name="file" placeholder="address">
     <p><strong>Si no se agrega archivo, se mantiene el archivo original.</strong></p>
     @if($errors->has('file'))
     <strong class="danger">{{$errors->first('file')}}</strong>
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
