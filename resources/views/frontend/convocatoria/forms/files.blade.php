
<p>
  @if($errors->has('aspirant_id'))
    <strong class="error">El <em>token</em> no es válido o recargaste la página, por favor revisa tu correo y da click al enlace para subir tus archivos.</strong>
  @endif
</p>

{!! Form::open(['url' => 'convocatoria/aplicar/registro', "class" => "form-horizontal",'files'=>true]) !!}
{{Form::hidden('aId', $aId, ["class" => "form-control"])}}
  <h2><label>Agregar Ensayo </label></h2>
<p>  {{Form::file('essay', null, ["class" => "form-control"])}} (no mayor a 5 cuartillas, documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
  @if($errors->has('essay'))
    <strong  class="error">{{$errors->first('essay')}}</strong>
  @endif
</p>


<h2><label>Agregar enlace a video (YouTube)</label></h2>
 <p> {{Form::text('video', null, ["class" => "form-control"])}}
  @if($errors->has('video'))
    <strong  class="error">{{$errors->first('video')}}</strong>
  @endif
</p>


 <h2> <label>Agregar perfil curricular</label></h2>
<p>  {{Form::file('cv', null, ["class" => "form-control"])}}  (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
  @if($errors->has('cv'))
    <strong  class="error">{{$errors->first('cv')}}</strong>
  @endif
</p>

<h2> <label>Agregar carta membretada </label></h2>
<p>  {{Form::file('letter', null, ["class" => "form-control"])}} (documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('letter'))
    <strong  class="error">{{$errors->first('letter')}}</strong>
  @endif
</p>

<h2> <label>Agregar copia de comprobante de domicilio </label></h2>
<p>
	{{Form::file('proof', null, ["class" => "form-control"])}}(documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('proof'))
    <strong  class="error">{{$errors->first('proof')}}</strong>
  @endif
</p>

<h2> <label>Agregar consentimiento relativo al tratamiento de sus datos personales</label></h2>
<p>  {{Form::file('privacy', null, ["class" => "form-control"])}} (documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('privacy'))
    <strong  class ="error">{{$errors->first('privacy')}}</strong>
  @endif
</p>

<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

	<p>{{Form::submit('Completar Aplicación', ['class' => 'btn gde i_convoca_w'])}}</p>
	</div>
</div>



{!! Form::close() !!}
