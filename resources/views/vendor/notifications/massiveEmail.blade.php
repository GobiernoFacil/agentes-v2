@component('mail::message')
Estimado/a candidato/a,<br>

Le enviamos un atento recordatorio para que complete su postulación al “Programa de Formación de Agentes de Locales de Cambio en Gobierno Abierto y Desarrollo Sostenible” subiendo la documentación que se solicita en la Convocatoria. De lo contrario su postulación no podrá ser evaluada.<br>

Le agradecemos atender este requerimiento cuanto antes dando clic en el enlace que a continuación se presenta. Le recordamos que la Convocatoria cierra el 28 de abril de 2017.<br>

@component('mail::button', ['url' => $url])
Continuar registro
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
