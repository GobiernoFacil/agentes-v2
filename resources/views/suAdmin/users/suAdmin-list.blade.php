<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($suAdmins as $user)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>
          <a href="{{ url('sa/dashboard/super-administradores/ver/' . $user->id) }}" class="btn xs view">Ver</a>
          <a href ="{{ url('sa/dashboard/super-administradores/eliminar' . $user->id) }}"  id ="{{$user->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
    </tr>
    @endforeach
  </tbody>
</table>


{{ $suAdmins->links() }}
