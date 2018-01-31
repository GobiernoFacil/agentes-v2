{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-aviso-privacidad", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


  <div class="row">
    <div class="col-sm-12">
        <p>Lee y acepta el Aviso de Privacidad por medio del cual otorgas el consentimiento relativo al tratamiento de tus datos personales: <br>
          <a href='{{url("tablero-aspirante/aviso-de-privacidad")}}'  class="btn view xs">  Leer el aviso de privacidad</a>
        </p>
    </div>
    <div class="col-sm-12">
        
		<div class="box last_activity">
        {{Form::checkbox('privacy_policies',1,$aspirantFile->privacy_polices, ['class' => '', 'id' => 'check_privacy_policies'])}}  <label for="check_privacy_policies">Acepto el Aviso de Privacidad por medio del cual otorgo el consentimiento relativo al tratamiento de mis datos personales </label>
        @if($errors->has('privacy_policies'))
        <strong class="error">{{$errors->first('privacy_policies')}}</strong>
        @endif
		</div>
		<div class="divider"></div>
    </div>
	
  </div>



<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <p>{{Form::submit('Aplicar a la Convocatoria', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
