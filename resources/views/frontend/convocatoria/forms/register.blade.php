{!! Form::open(['url' => 'convocatoria/aplicar', "class" => "form-horizontal"]) !!}
<div class="row">
	<div class="col-sm-12">
		<p>
		  <label>Nombre(s)</label>
		  {{Form::text('name', null, ["class" => "form-control"])}}
		  @if($errors->has('name'))
		    <strong>{{$errors->first('name')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-6">
		<p>
		  <label>Apellido Paterno</label>
		  {{Form::text('surname', null, ["class" => "form-control"])}}
		  @if($errors->has('surname'))
		    <strong>{{$errors->first('surname')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-6">
		<p>
		  <label>Apellido Materno</label>
		  {{Form::text('lastname', null, ["class" => "form-control"])}}
		  @if($errors->has('lastname'))
		    <strong>{{$errors->first('lastname')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-12">
		<p>
		  <label>Grado de estudios completados</label>
		  {{Form::text('degree', null, ["class" => "form-control"])}}
		  @if($errors->has('degree'))
		    <strong>{{$errors->first('degree')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-6">
		<p>
		  <label>Correo</label>
		  {{Form::text('email', null, ["class" => "form-control"])}}
		  @if($errors->has('email'))
		    <strong>{{$errors->first('email')}}</strong>
		  @endif
		</p>
	</div>
	<!--confirmar correo-->
	<div class="col-sm-6">	
		<p>
		  <label>Confirmar correo</label>
		  {{Form::text('email-confirm', null, ['class' => 'form-control'])}}
		  @if($errors->has('email-confirm'))
		    <strong>{{$errors->first('email-confirm')}}</strong>
		  @endif
		</p>
	</div>
	<!--estado-->
	<div class="col-sm-6">
		<p>
		  <label>Estado</label>
		  {{Form::text('state',null, ['class' => 'form-control'])}}
		  @if($errors->has('state'))
		    <strong>{{$errors->first('state')}}</strong>
		  @endif
		</p>
	</div>
	<!--ciudad-->
	<div class="col-sm-6">
		<p>
		  <label>Ciudad</label>
		  {{Form::text('city',null, ['class' => 'form-control'])}}
		  @if($errors->has('city'))
		    <strong>{{$errors->first('city')}}</strong>
		  @endif
		</p>
	</div>
	<div class="col-sm-12">
		<p>Acepto	<a href="{{url('politica-privacidad')}}">Política de Privacidad</a></p>
	</div>
	<div class="col-sm-6 col-sm-offset-3">
		
		<p>{{Form::submit('Aplicar', ['class' => 'btn gde'])}}</p>
	</div>
</div>
{!! Form::close() !!}
