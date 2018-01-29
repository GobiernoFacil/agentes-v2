{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-comprobante-domicilio", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


  <div class="row">
    <div class="col-sm-12">
  	  <h2>Comprobante de domicilio</h2>
        <p><label>Adjunta tu comprobante de domicilio, recuerda verificar antes tu documento, el peso máximo 2.5MB en formato: jpg,jpeg o PDF</label></p>
        {{Form::file('proof', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato jpg, jpeg, png o pdf)
        @if($errors->has('proof'))
        <strong class="error">{{$errors->first('proof')}}</strong>
        @endif

    </div>

  </div>


  @if($aspirantFile->proof)
  <div class="row">
   <div class="col-sm-12">
        <ul class="profile list">
         <li class="download"><a href='{{url("tablero-aspirante/archivo/download/$aspirantFile->proof/comprobante")}}'  class="btn view xs"> Descargar Comprobante de Domicilio</a></li>
       </ul>
   </div>
  </div>
  @endif

<div class="row">
  <div class="col-sm-3 col-sm-offset-9">
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
