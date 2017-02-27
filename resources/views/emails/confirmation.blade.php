Hola, {{ $aspirant->name.' '.$aspirant->surname." ".$aspirant->lastname }}<br>

<p>Por favor sigue el siguiente enlace para activar tu cuenta: {{ url('convocatoria/aplicar/confirmacion', $link)}}</p>
