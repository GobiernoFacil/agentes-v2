{!! Form::model($aspirantFile,['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-comprobante-domicilio", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


  <div class="row">
    <div class="col-sm-12">
  	  <h2>Comprobante de domicilio</h2>
      @if($aspirantFile->proof)
        <p>Ya has adjuntado un comprobante de domicilio, si deseas actualizarlo, has clic en el botón de abajo, recuerda verificar antes tu documento, el peso máximo 2.5MB en formato: jpg, jpeg, png o pdf.</p>
       @else
        <p>Adjunta tu comprobante de domicilio reciente que acredite tu residencia, recuerda verificar antes tu documento, el peso máximo 2.5MB en formato: jpg, jpeg, png o pdf.</p>
       @endif
  	  <div id ="inputFile" class="box last_activity" style= "{{$aspirantFile->proof ? 'display:none;' : ''}}">
        <p class="center"><label>
        {{Form::file('proof', ['class' => ''])}} <br>(documento no mayor a 2.5 Mb, formato jpg, jpeg, png o pdf)
        </label></p>
        @if($errors->has('proof'))
        <strong class="error">{{$errors->first('proof')}}</strong>
        @endif
  	  </div>
      <div id ="updateBoxB" class="box last_activity update" style= "{{$aspirantFile->proof ? '' : 'display:none;'}}">
        <p class="center"><label>
          <ul class="profile list center">
           <li class="download"><a href='{{url("")}}'  class="btn view s" id = "update_b"> Actualizar Comprobante de Domicilio</a></li>
         </ul>
        </label>
      </p>
      @if($errors->has('proof'))
      <strong class="error">{{$errors->first('proof')}}</strong>
      @endif
      </div>
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
