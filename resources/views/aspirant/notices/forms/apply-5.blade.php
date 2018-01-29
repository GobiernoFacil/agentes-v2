{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-aviso-privacidad", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


  <div class="row">
    <div class="col-sm-12">
  	  <h2>Aviso de Privacidad</h2>
        <p><label>Da click para leer el aviso de privacidad</label></p>
        <p>
          <a href='{{url("tablero-aspirante/aviso-de-privacidad")}}'  class="btn view xs" target="_blank"> Aviso de Privacidad</a>
        </p>
        {{Form::checkbox('privacy_policies',1,$aspirantFile->privacy_polices, ['class' => ''])}} Acepto
        @if($errors->has('privacy_policies'))
        <strong class="error">{{$errors->first('privacy_policies')}}</strong>
        @endif

    </div>

  </div>



<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Aplicar a la Convocatoria', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
