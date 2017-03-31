{!! Form::open(['url' => 'convocatoria/aplicar', "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
		<p>
		  <label>Nombre(s)</label>
		  {{Form::text('name', null, ["class" => "form-control"])}}
		  @if($errors->has('name'))
		    <strong class="error">{{$errors->first('name')}}</strong>
		  @endif
		</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<p>
		  <label>Apellido Paterno</label>
		  {{Form::text('surname', null, ["class" => "form-control"])}}
		  @if($errors->has('surname'))
		    <strong class="error">{{$errors->first('surname')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-6">
		<p>
		  <label>Apellido Materno</label>
		  {{Form::text('lastname', null, ["class" => "form-control"])}}
		  @if($errors->has('lastname'))
		    <strong class="error">{{$errors->first('lastname')}}</strong>
		  @endif
		</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<p>
		  <label>Grado de estudios completados</label>
		  {{Form::text('degree', null, ["class" => "form-control"])}}
		  @if($errors->has('degree'))
		    <strong class="error">{{$errors->first('degree')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-6">
		<p>
		  <label>Sector de procedencia</label>
			{{Form::select('origin',[null => "Selecciona una opción", 'Gobierno' =>'Gobierno', 'Sociedad Civil'=>'Sociedad Civil', 'Sector Privado'=>'Sector Privado', 'Sector Académico'=>'Sector Académico'],null, ['class' => 'form-control'])}}
		  @if($errors->has('origin'))
		    <strong class="error">{{$errors->first('origin')}}</strong>
		  @endif
		</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<p>
		  <label>Correo</label>
		  {{Form::text('email', null, ["class" => "form-control"])}}
		  @if($errors->has('email'))
		    <strong class="error">{{$errors->first('email')}}</strong>
		  @endif
		</p>
	</div>
	<!--confirmar correo-->
	<div class="col-sm-6">
		<p>
		  <label>Confirmar correo</label>
		  {{Form::text('email-confirm', null, ['class' => 'form-control'])}}
		  @if($errors->has('email-confirm'))
		    <strong class="error">{{$errors->first('email-confirm')}}</strong>
		  @endif
		</p>
	</div>
</div>
<div class="row">
	<!--estado-->
	<div class="col-sm-6">
		<p>
		  <label>Estado</label>
		  {{Form::select('state',[null => "Selecciona una opción", 'Chihuahua' =>'Chihuahua', 'Morelos'=>'Morelos', 'Nuevo León'=>'Nuevo León', 'Oaxaca'=>'Oaxaca','Sonora'=>'Sonora'],null, ['class' => 'form-control','id'=>'state'])}}
		  @if($errors->has('state'))
		    <strong class="error">{{$errors->first('state')}}</strong>
		  @endif
		</p>
	</div>
	<!--ciudad-->
	<div class="col-sm-6">
		<p>
		  <label>Ciudad</label>
		  {{Form::select('city',[null => "Selecciona una opción"], null,['class' => 'form-control','id'=>'city'])}}
		  @if($errors->has('city'))
		    <strong class="error">{{$errors->first('city')}}</strong>
		  @endif
		</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-sm-offset-3">

		<p>{{Form::submit('Aplicar', ['class' => 'btn gde i_convoca_w'])}}</p>
	</div>
</div>
{!! Form::close() !!}
