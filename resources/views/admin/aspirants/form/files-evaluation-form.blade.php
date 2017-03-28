{!! Form::model($filesEva,['url' => url('dashboard/aspirantes/evaluar-archivos').'/'.$aspirant->id, "class" => "form-horizontal"]) !!}
<div class="divider"></div>
<div class="row">
  <div class="col-sm-12">
    <h2 class="sa_title">Validación de archivos</h2>
	<ol class="list line">
		<li>
    		<p>¿El aspirante proporciona un <strong>enlace de video</strong> válido?</p>
			<p>
				<label>Sí {{Form::radio('hasVideo[0]','1', $filesEva->hasVideo== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasVideo[1]','0', ($filesEva->hasVideo == 0 && !is_null($filesEva->hasVideo)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasVideo'))</label>
				<strong class="danger">{{$errors->first('hasVideo')}}</strong>
			@endif
		</li>
    <li>
    		<p>¿El aspirante proporciona un <strong>Perfil Curricular</strong> válido?</p>
			<p>
				<label>Sí {{Form::radio('hasCv[0]','1', $filesEva->hasCv== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasCv[1]','0', ($filesEva->hasCv == 0 && !is_null($filesEva->hasCv)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasCv'))</label>
				<strong class="danger">{{$errors->first('hasCv')}}</strong>
			@endif
		</li>
    <li>
    		<p>¿El aspirante proporciona un <strong>Ensayo</strong> válido?</p>
			<p>
				<label>Sí {{Form::radio('hasEssay[0]','1', $filesEva->hasEssay== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasEssay[1]','0', ($filesEva->hasEssay == 0 && !is_null($filesEva->hasEssay)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasEssay'))</label>
				<strong class="danger">{{$errors->first('hasEssay')}}</strong>
			@endif
		</li>
    <li>
    		<p>¿El aspirante proporciona una <strong>Carta de Membretada</strong> válida?</p>
			<p>
				<label>Sí {{Form::radio('hasLetter[0]','1', $filesEva->hasLetter== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasLetter[1]','0', ($filesEva->hasLetter == 0 && !is_null($filesEva->hasLetter)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasLetter'))</label>
				<strong class="danger">{{$errors->first('hasLetter')}}</strong>
			@endif
		</li>
    <li>
    		<p>¿El aspirante proporciona un <strong>Comprobante de Domicilio</strong> válido?</p>
			<p>
				<label>Sí {{Form::radio('hasProof[0]','1', $filesEva->hasProof== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasProof[1]','0', ($filesEva->hasProof == 0 && !is_null($filesEva->hasProof)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasProof'))</label>
				<strong class="danger">{{$errors->first('hasProof')}}</strong>
			@endif
		</li>
    <li>
    		<p>¿El aspirante proporciona un <strong>Consentimiento Relativo Al Tratamiento de sus Datos Personales</strong> válido?</p>
			<p>
				<label>Sí {{Form::radio('hasPrivacy[0]','1', $filesEva->hasPrivacy== 1 ? true : false,['class' => 'form-control experience'])}}</label>
				<label>No {{Form::radio('hasPrivacy[1]','0', ($filesEva->hasPrivacy == 0 && !is_null($filesEva->hasPrivacy)) ? true : false,['class' => 'form-control experience'])}}
			</p>
			@if($errors->has('hasPrivacy'))</label>
				<strong class="danger">{{$errors->first('hasPrivacy')}}</strong>
			@endif
		</li>

	</ol>
  </div>
</div>



<div class="row">
  <div class="col-sm-12">
    <p>{{Form::submit('Guardar evaluación', ['class' => 'btn gde'])}}</p>
  </div>
</div>
{!! Form::close() !!}
