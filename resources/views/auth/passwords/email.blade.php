@extends('layouts.frontend.master')
@section('title', 'Recuperar Contraseña')
@section('description', 'Recuperar contraseña en la Plataforma del Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible')
@section('body_class', 'login')
@section('canonical', url('password/reset'))

@section('content')
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
	    <h1 class="center">Recuperar Contraseña</h1>
    </div>
    <div class="col-sm-6 col-sm-offset-3">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
             {{ csrf_field() }}
             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
             </div>

            <button type="submit" class="btn btn-login">
                Enviar enlace para recuperar contraseña
            </button>
         </form>
    </div>
</div>
@endsection