{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-video", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


<div class="row">
  <div class="col-sm-12">
	  <h2>Video Youtube</h2>
      <p><label>Agrega el url de tu video en Youtube</label></p>
      {{Form::text('video', null, ["class" => "form-control","id"=>"video"])}}
      @if($errors->has('video'))
      <strong class="error">{{$errors->first('video')}}</strong>
      @endif
      <strong class="error" id ="urlError" style="display:none;">Escribe un URL válido</strong>
    </p>
  </div>
</div>


<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
