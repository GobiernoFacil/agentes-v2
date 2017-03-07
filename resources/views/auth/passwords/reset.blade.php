@extends('layouts.frontend.master')
@section('title', 'Cambiar Contraseña')
@section('description', 'Actualizar contraseña en la Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'login')

@section('content')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
	    <h1>Cambiar Contraseña</h1>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
       @if (session('status'))
           <div class="alert alert-success">
               {{ session('status') }}
           </div>
       @endif

       <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
           {{ csrf_field() }}

           <input type="hidden" name="token" value="{{ $token }}">

           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Correo electrónico" required autofocus>
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

           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
           		<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
		   		
           		@if ($errors->has('password_confirmation'))
           		    <span class="help-block">
           		        <strong>{{ $errors->first('password_confirmation') }}</strong>
           		    </span>
           		@endif
           </div>

           
            <button type="submit" class="btn btn-login">
                Cambiar Contraseña
            </button>
       </form>
    </div>
</div>
@endsection