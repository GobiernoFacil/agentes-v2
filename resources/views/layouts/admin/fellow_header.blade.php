
<header>
	<a class="apertus" href="{{url('')}}" title="Regresar a inicio">Gobierno Abierto desde lo local para el desarrollo sostenible</a>

	<nav>
		<ul>
				<!--dashboard-->
				<li class="{{ $__env->yieldContent('body_class') == 'dashboard' || $__env->yieldContent('body_class') == 'dashboard fellow' ? "active" : ''}}"><a href="{{url($linkDash)}}" data-title="Tablero"><b class="icon i_tablero"></b></a></li>
				@if($user->type == "admin")
				<!--admin-->
				<li class="{{ $__env->yieldContent('body_class') == 'fellows' ? "active" : ''}}"><a href="{{url('dashboard/fellows')}}"><b class="icon i_aspirantes"></b> Fellows</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'modulos' || $__env->yieldContent('body_class') == 'modulos view' ? "active" : ''}}"><a href="{{url('dashboard/modulos')}}"><b class="icon i_modulos"></b> MÓDULOS</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'facilitadores' ? "active" : ''}}"><a href="{{url('dashboard/facilitadores')}}"><b class="icon i_facilitador"></b> FACILITADORES</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'foros' ? "active" : ''}}"><a href="{{url( $linkDash . '/foros')}}"><b class="icon i_foros"></b> Foros</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'notice' ? "active" : ''}}"><a href="{{url( $linkDash . '/convocatorias')}}"><b class="icon i_foros"></b> Convocatorias</a></li>
				@endif
				@if($user->type == "superAdmin")
				<!--superadmin-->
				<li class="{{ $__env->yieldContent('body_class') == 'suAdmin' ? "active" : ''}}"><a href="{{url( $linkDash . '/super-administradores')}}"><b class="icon i_usuarios"></b> Super Admin</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'users' ? "active" : ''}}"><a href="{{url( $linkDash . '/administradores')}}"><b class="icon i_usuarios"></b> Administradores</a></li>
				@endif
				@if($user->type == "facilitator")
				<!--facilitador-->
				<li class="{{ $__env->yieldContent('body_class') == 'actividades' ? "active" : ''}}"><a href="{{url( $linkDash . '/actividades')}}"><b class="icon i_facilitador"></b> Actividades</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'mensajes' ? "active" : ''}}"><a href="{{url( $linkDash . '/mensajes')}}"><b class="icon i_mensajes"></b> Mensajes</a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'foros' ? "active" : ''}}"><a href="{{url( $linkDash . '/foros')}}"><b class="icon i_foros"></b> Foros</a></li>
				@endif
				@if($user->type == "fellow")
				<!--fellow-->
				<li class="{{ $__env->yieldContent('body_class') == 'fellow aprendizaje' || $__env->yieldContent('body_class') ==  'fellow aprendizaje modulos' ? "active" : ''}}"><a href="{{url( $linkDash . '/aprendizaje')}}" data-title="Aprendizaje"><b class="icon i_modulos"></b></a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'fellow mensajes' ? "active" : ''}}"><a href="{{url( $linkDash . '/mensajes')}}" data-title="Mensajes"><b class="icon i_mensajes"></b></a></li>
				<li class="{{ $__env->yieldContent('body_class') == 'fellow foros' ? "active" : ''}}"><a href="{{url( $linkDash . '/foros')}}" data-title="Foros"><b class="icon i_foros"></b></a></li>
				@endif
				@if($user->type == "aspirant")
				<!--aspirant-->
				<li class="{{ $__env->yieldContent('body_class') == 'aspirante convocatoria'  ? "active" : ''}}"><a href="{{url( $linkDash . '/convocatorias')}}"><b class="icon i_modulos"></b> Convocatorias</a></li>
				@endif
			</ul>
		</nav>
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
