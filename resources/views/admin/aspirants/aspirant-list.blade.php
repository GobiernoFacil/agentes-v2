<table class="table">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Email</th>
      <th>Ciudad, Estado</th>
      <th>Puntaje</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($aspirants as $aspirant)
      <tr>
        <td>{{$aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname}}</td>
        <td>{{$aspirant->email}}</td>
        <td>{{$aspirant->city}}, {{$aspirant->state}}</td>
        @if($aspirant->aspirantEvaluation)
        <td>{{($aspirant->aspirantEvaluation->grade*10).'%'}}</td>
        @else
        <td>Sin calificación</td>
        @endif
        <td>
          <a href="{{ url('dashboard/aspirantes/ver/' . $aspirant->id) }}" class="btn xs view">Ver</a>
          <a href="{{ url('dashboard/aspirantes/evaluar/' . $aspirant->id) }}" class="btn xs view">Evaluar</a>
          <a href ="{{ url('dashboard/aspirantes/eliminar' . $aspirant->id) }}"  id ="{{$aspirant->id}}" class="btn xs danger" onclick="return confirm('¿Estás seguro?');">Eliminar</a></td>
    </tr>
    @endforeach
  </tbody>
</table>

  {{ $aspirants->links() }}
