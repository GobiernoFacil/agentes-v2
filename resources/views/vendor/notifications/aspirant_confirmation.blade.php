@component('mail::message')

Estimado/a {{$aspirant->name." ".$aspirant->surname." ".$aspirant->lastname}},<br>

Muchas gracias por tu interés en la convocatoria {{$notice->title}}. <br>

Por favor sigue el siguiente enlace para activar tu cuenta. <br>

<strong><a href ='{{$url}}'>Confirma tu correo</a></strong><br>


@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
