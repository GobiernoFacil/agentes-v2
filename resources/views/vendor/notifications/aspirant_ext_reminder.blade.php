@component('mail::message')

Estimado/a {{$user->name." ".$user->surname." ".$user->lastname}},<br>

Por este medio le informamos que el tiempo para completar su postulación al “Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible” se ha extendido en la plataforma, por lo que lo invitamos a terminar su registro lo más pronto posible. De lo contrario su postulación no podrá ser evaluada.<br>

Le agradecemos atender este requerimiento cuanto antes dando clic en el enlace que a continuación se presenta.<br>


@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
