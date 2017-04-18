<?php
	if($user->type == "admin") {
		$linkDash = "dashboard";
	}else if($user->type == "fellow"){
		$linkDash = "tablero";
	}else {
		$linkDash = "sa/dashboard";
	}

?>

<header>
	<div class="col-sm-3 logo">
		<a class="apertus" href="{{url('')}}" title="Regresar a inicio">Gobierno Abierto desde lo local para el desarrollo sostenible</a>
	</div>
	<div class="col-sm-7">
		<nav>
			<ul>
				<li class="{{ $__env->yieldContent('body_class') == 'dashboard' ? "active" : ''}}"><a href="{{url($linkDash)}}"><b class="icon i_tablero"></b> Tablero</a></li>
				@if($user->type == "admin")
				<li class="{{ $__env->yieldContent('body_class') == 'aspirantes' ? "active" : ''}}"><a href="{{url('dashboard/aspirantes')}}"><b class="icon i_aspirantes"></b> ASPIRANTES</a></li>
				<li class="{{ $__env->yieldContent('body_class') == '' ? "active" : ''}}"><a href="{{url('dashboard/facilitadores')}}"><b class="icon i_usuarios"></b> FACILITADORES</a></li>
				<li class="{{ $__env->yieldContent('body_class') == '' ? "active" : ''}}"><a href="{{url('dashboard/modulos')}}"><b class="icon i_aspirantes"></b> MÓDULOS</a></li>
				@endif
				@if($user->type == "superAdmin")
				<li class="{{ $__env->yieldContent('body_class') == 'suAdmin' ? "active" : ''}}"><a href="{{url( $linkDash . '/super-administradores')}}"><b class="icon i_usuarios"></b> Super Admin</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'users' ? "active" : ''}}"><a href="{{url( $linkDash . '/administradores')}}"><b class="icon i_usuarios"></b> Administradores</a></li>
				@endif
			</ul>
		</nav>
	</div>
	<div class="col-sm-2 right">
		<a class ="logout" href="{{ url('/logout') }}"
				onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
				Cerrar sesión
		</a>

		<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
		</form>
		<p>Hola, <strong>{{$user->name}}</strong>.<br> <a href="{{url( $linkDash . '/perfil' )}}" class="edit_profile">Ver Perfil</a></p>
	</div>
	<div class="clearfix"></div>
</header>
