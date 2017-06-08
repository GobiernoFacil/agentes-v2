@component('mail::message')
Estimado/a {{$user->name." ".$user->fellowData->surname." ".$user->fellowData->lastname}},<br>

Por este medio, te proporcionamos tu nombre de usuario y tu contraseña para acceder a la plataforma Apertus.<br>
<strong>Usuario:</strong> {{$user->email}}<br>
<strong>Contraseña:</strong> {{$password}}<br>

La contraseña la podrás modificar para fines de privacidad en la liga <a href ="www.apertus.org.mx/tablero/perfil/editar">www.apertus.org.mx/tablero/perfil/editar</a>, donde además puedes completar tu perfil con tu foto, semblanza y redes sociales. La liga para acceder a los contenidos de la plataforma, incluyendo el examen diagnóstico y los módulos de enseñanza es <a href="www.apertus.org.mx/login">www.apertus.org.mx/login</a><br>

Te recordamos que el examen diagnóstico estará disponible en la plataforma para responder en línea del 9 al 14 de junio y que el curso propedéutico en línea tendrá lugar del 14 al 16 de junio.

Saludos

@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
