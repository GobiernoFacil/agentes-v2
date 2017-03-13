<header>
	<div class="col-sm-3 logo">
		<a class="apertus" href="{{url('')}}" title="Regresar a inicio">Gobierno Abierto desde lo local para el desarrollo sostenible</a>
	</div>
	<div class="col-sm-7">
		<nav>
			<ul>
				<li class="{{ $__env->yieldContent('body_class') == 'dashboard' ? "active" : ''}}"><a href="{{url('dashboard')}}"><b class="icon i_tablero"></b> Tablero</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'aspirantes ver' ? "active" : ''}}"><a href="{{url('dashboard/aspirantes')}}"><b class="icon i_aspirantes"></b> ASPIRANTES</a></li>
				<!---
				<li><a href="{{url('dashboard')}}">USUARIOS</a></li> ---->

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
		<p>Hola, <strong>{{$user->name}}</strong>.<br> <a href="{{url('dashboard/perfil')}}" class="edit_profile">Ver Perfil</a></p>
	</div>
	<div class="clearfix"></div>
</header>