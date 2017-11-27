{!! Form::open(['url' => url('dashboard/convocatorias/agregar-archivos/'.$notice->id),'files'=>true]) !!}
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
     <label><strong>Archivos</strong></label>
     <p>Selecciona uno o varios archivos (DOC, DOCX o PDF), el tamaño máximo es de 2.5MB</p>
     <input type="file" class="form-control" name="filesData[]" placeholder="address" multiple>
     {{var_dump($errors->toArray())}}
     @if($errors->has('filesData'))
     <strong class="danger">{{$errors->first('filesData')}}</strong>
     @endif
     @if($errors->has('limitNumber'))
     <strong class="danger">{{$errors->first('limitNumber')}}</strong>
     @endif
     @if($errors->has('filesDataR'))
     <strong class="danger">{{$errors->first('filesDataR')}}</strong>
     @endif
   </p>
 </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar archivos', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
