<header>
	<div class="col-sm-3 logo">
		<a class="apertus" href="{{url('')}}" title="Regresar a inicio">Gobierno Abierto desde lo local para el desarrollo sostenible</a>
	</div>
	<div class="col-sm-7">
		<nav>
			<ul>
				<li><a href="{{url('dashboard')}}">Tablero</a></li>
				<li><a href="{{url('dashboard')}}">ASPIRANTES</a></li>
				<li><a href="{{url('dashboard')}}">USUARIOS</a></li>

			</ul>
		</nav>
	</div>
	<div class="col-sm-2 right">
		<a class="logout">Cerrar sesión</a> 
		<p>Hola, <strong>{{$user->name}}</strong>.<br> <a class="edit_profile">Editar Perfil</a></p>
	</div>
	<div class="clearfix"></div>
</header>