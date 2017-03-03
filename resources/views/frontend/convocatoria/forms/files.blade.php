{!! Form::open(['url' => 'convocatoria/aplicar/registro', "class" => "form-horizontal",'files'=>true]) !!}

  <h2><label>Agregar Ensayo </label></h2>
<p>  {{Form::file('essay', null, ["class" => "form-control"])}} (no mayor a 5 cuartillas, documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
  @if($errors->has('essay'))
    <strong>{{$errors->first('essay')}}</strong>
  @endif
</p>


<h2><label>Agregar enlace a video (YouTube)</label></h2>
 <p> {{Form::text('video', null, ["class" => "form-control"])}}
  @if($errors->has('video'))
    <strong>{{$errors->first('video')}}</strong>
  @endif
</p>


 <h2> <label>Agregar perfil curricular</label></h2>
<p>  {{Form::file('cv', null, ["class" => "form-control"])}}  (documento no mayor a 2.5 Mb, formato .docx, .doc o pdf)
  @if($errors->has('cv'))
    <strong>{{$errors->first('cv')}}</strong>
  @endif
</p>

<h2> <label>Agregar carta membretada </label></h2>
<p>  {{Form::file('cv', null, ["class" => "form-control"])}} (documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('cv'))
    <strong>{{$errors->first('cv')}}</strong>
  @endif
</p>

<h2> <label>Agregar copia de comprobante de domicilio </label></h2>
<p>  
	{{Form::file('cv', null, ["class" => "form-control"])}}(documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('cv'))
    <strong>{{$errors->first('cv')}}</strong>
  @endif
</p>

<h2> <label>Agregar consentimiento relativo al tratamiento de sus datos personales</label></h2>
<p>  {{Form::file('cv', null, ["class" => "form-control"])}} (documento no mayor a 2.5 Mb, formato .jpg, .png o pdf)
  @if($errors->has('cv'))
    <strong>{{$errors->first('cv')}}</strong>
  @endif
</p>

<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

	<p>{{Form::submit('Completar Aplicación', ['class' => 'btn gde i_convoca_w'])}}</p>
	</div>
</div>



{!! Form::close() !!}
