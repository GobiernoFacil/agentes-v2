@component('mail::message')
Estimado/a {{$user->name." ".$user->aspirant($user)->surname." ".$user->aspirant($user)->lastname}},<br>

Muchas gracias por aplicar a la convocatoria "{{$notice->title}}" <br>

Tus datos han sido guardados correctamente, pronto recibirás nuevas noticias.<br>

Recuerda que puedes actualizar tu información mientras se encuentre abierta la convocatoria.

Saludos

@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
