<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Ciudad, Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($aspirants as $aspirant)
      <tr>
        <td>{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</td>
        <td>{{$aspirant->email}}</td>
        <td>{{$aspirant->city}}, {{$aspirant->state}}</td>
        <td>
          <a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}" class="btn xs view">Ver</a>
          <a href="{{ url('dashboard/aspirantes/evaluar/' . $aspirant->id) }}" class="btn xs view">Evaluar</a>
          <a href ="{{ url('dashboard/aspirantes/eliminar' . $aspirant->id) }}"  id ="{{$aspirant->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
