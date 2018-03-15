{!! Form::model($aspirantEvaluation,['url' => url("dashboard/aspirantes/convocatoria/$notice->id/evaluar-comprobante/$aspirant->id"), "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
    	<h2 class="sa_title">Revisar si comprobante de domicilio corresponde a <strong>{{ $aspirant->city }}, {{ $aspirant->state }}</strong> </h2>
		
    </div>
    <div class="col-sm-4">
	    <p class="right"><strong>Comprobante de domicilio:</strong></p>
    </div>
    <div class="col-sm-8">
	    <p><a href='{{url("dashboard/aspirantes/convocatoria/$notice->id/comprobante/{$aspirant->AspirantsFile->proof}")}}'  class="btn ev"> Descargar Comprobante de Domicilio</a></p>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
	    <div class="divider"></div>
    	<ul class="list_line">
    		<li class="center">
        		<p>¿Es un comprobante válido y corresponde a <strong>{{ $aspirant->city }}, {{ $aspirant->state }}</strong>?</p>
    			<p>
    				<label><strong>Sí</strong> {{Form::radio('address_proof[0]','1', $aspirantEvaluation->address_proof ? true:false,['class' => 'form-control address_proof'])}}</label>
    				<label><strong>No</strong> {{Form::radio('address_proof[1]','0', !$aspirantEvaluation->address_proof ? true:false,['class' => 'form-control address_proof'])}}
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
