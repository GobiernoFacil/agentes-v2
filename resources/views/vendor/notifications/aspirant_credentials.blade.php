@component('mail::message')
Estimado/a {{$user->name}},<br>

Por este medio, te proporcionamos tu nombre de usuario y tu contraseña para acceder a la plataforma Apertus.<br>
<strong>Usuario:</strong> {{$user->email}}<br>
<strong>Contraseña:</strong> {{$password}}<br>

La contraseña la podrás modificar para fines de privacidad en la liga <a href ="www.apertus.org.mx/tablero-aspirante/perfil/editar">editar perfil</a>, donde además puedes completar tu perfil con tu foto. La liga para acceder a la plataforma y continuar con el proceso de selección es <a href="{{$url}}">www.apertus.org.mx/login</a><br>


@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
