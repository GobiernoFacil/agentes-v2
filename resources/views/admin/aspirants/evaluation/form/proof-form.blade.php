{!! Form::model($aspirantEvaluation,['url' => url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-comprobante/$aspirant->id"), "class" => "form-horizontal"]) !!}

  <div class="row">
    <div class="col-sm-12">
      <h2 class="sa_title">Evaluar comprobante de domicilio </h2>
      <a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/comprobante/{$aspirant->AspirantsFile->proof}")}}'  class="btn view xs"> Descargar Comprobante de Domicilio</a>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
    	<ul class="list line">
    		<li>
        		<p>¿Es un comprobante válido?</p>
    			<p>
    				<label>Sí {{Form::radio('address_proof[0]','1', $aspirantEvaluation->address_proof ? true:false,['class' => 'form-control address_proof'])}}</label>
    				<label>No {{Form::radio('address_proof[1]','0', !$aspirantEvaluation->address_proof ? true:false,['class' => 'form-control address_proof'])}}
    			</p>
    			@if($errors->has('address_proof'))</label>
    				<strong class="danger">{{$errors->first('address_proof')}}</strong>
    			@endif
    		</li>
      </ul>
    </div>
  </div>

<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
