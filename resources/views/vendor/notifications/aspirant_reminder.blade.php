@component('mail::message')

Estimado/a {{$user->name." ".$user->surname." ".$user->lastname}},<br>

Le enviamos un atento recordatorio para que complete su postulación al “Programa de Formación de Agentes Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible” terminando su registro en la plataforma. De lo contrario su postulación no podrá ser evaluada.<br>
<?php
use Jenssegers\Date\Date;
$date =  Date::createFromFormat('Y-m-d',$notice->end);
?>
Le agradecemos atender este requerimiento cuanto antes dando clic en el enlace que a continuación se presenta. Le recordamos que la Convocatoria cierra el {{ $date->format('j  \d\e F \d\e Y') }}.<br>


@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
