@extends('layouts.frontend.master')
@section('title', 'Iniciar Sesión')
@section('description', 'Iniciar sesión en la Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'login')
@section('canonical', url('login'))

@section('content')
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<h1 class="center">Iniciar Sesión</h1>
	</div>
    <div class="col-md-6 col-md-offset-3">
    	<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
    	    {{ csrf_field() }}
		
    	    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    	            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>		
    	            @if ($errors->has('email'))
    	                <span class="help-block">
    	                    <strong>{{ $errors->first('email') }}</strong>
    	                </span>
    	            @endif
    	    </div>
		
    	    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">		
    	            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
		
    	            @if ($errors->has('password'))
    	                <span class="help-block">
    	                    <strong>{{ $errors->first('password') }}</strong>
    	                </span>
    	            @endif
    	    </div>
		
    	    <div class="form-group notes">
    	            <div class="checkbox">
	    	            <p>
    	                <label>
    	                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar mis datos
    	                </label>
	    	            </p>
    	            </div>
    	    </div>
		
    	    <div class="row">
    	        <div class="col-sm-8">
    	            <button type="submit" class="btn btn-login">
    	                Iniciar Sesión
    	            </button>
    	        </div>
    	           <div class="col-sm-4 notes">
				   	<p  class="right">
    	            <a href="{{ url('/password/reset') }}">
    	                ¿Olvidaste tu contraseña?
    	            </a>
				   	</p>
    	        </div>
    	    </div>
    	</form>
    </div>
</div>
@endsection