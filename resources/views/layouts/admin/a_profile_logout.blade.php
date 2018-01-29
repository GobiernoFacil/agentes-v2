<div class="apertus_profile_logout">
	<a class="account" >
		<img src='{{ $user->image ? url("img/users/" . $user->image->name) : url("img/users/default.png") }}' height="50px">
	</a>
	<div class="submenu">
		<ul>
			<li><a href="{{url( $linkDash . '/perfil' )}}" class="edit_profile">Perfil</a></li>
			<li><a class ="logout" href="{{ url('/logout') }}"
				onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
				Cerrar sesión
				</a>
				<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
				</form>
			</li>
		</ul>
	</div>
</div>