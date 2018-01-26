{!! Form::open(['url' => "tablero-aspirante/convocatorias/$notice->slug/aplicar/agregar-comprobante-domicilio", "class" => "form-horizontal",'id'=>'filesForm','files'=>true]) !!}


<div class="row">
  <div class="col-sm-12">
    <p>
      <label><strong>Comprobante de domicilio</strong></label><br>
      <p>Adjunta tu comprobantede domicilio, recuerda verificar antes tu documento, el peso máximo 2.5MB en formato: jpg,jpeg o PDF</p>
      {{Form::file('proof', ['class' => ''])}} (documento no mayor a 2.5 Mb, formato jpg, jpeg, png o pdf)
      @if($errors->has('proof'))
      <strong class="error">{{$errors->first('proof')}}</strong>
      @endif
    </p>
  </div>
</div>


<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Continuar', ['class' => 'btn gde'])}}</p>
  </div>
</div>


{!! Form::close() !!}
