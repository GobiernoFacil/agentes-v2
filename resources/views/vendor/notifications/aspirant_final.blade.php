@component('mail::message')

{{$aspirant->gender === 'female' ? 'Estimada ' : 'Estimado '}} {{$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname}}

Las instituciones convocantes al Programa de Formación de Agentes de Cambio en Gobierno Abierto y Desarrollo Sostenible queremos agradecer su participación en el proceso para formar parte de esta iniciativa en tu entidad federativa.
En esta ocasión, su postulación no ha sido aceptada. <br>

<strong>Los resultados de la convocatoria se encuentran disponibles en la página {{$url_results}}.
Le invitamos a consultar su desempeño ingresando al sitio electrónico y verificando su número de folio asignado para la evaluación:  {{$aspirant->id}}.
</strong><br>

Reconocemos el esfuerzo por promover la participación, la transparencia y la rendición de cuentas en su entidad y le invitamos a seguir consultando la plataforma de
{{$url_web}} para consultar información relevante.<br>

Para cualquier duda o comentario, favor de contactar a la Coordinadora de Proyecto “Prácticas de Gobierno Abierto para los ODS” en el PNUD México
en la dirección de correo electrónico <a href="mailto:mariana.garcia@undp.org">mariana.garcia@undp.org</a><br>
<br>
A nombre del Comité Dictaminador,<br>

Mariana García<br>
Coordinadora del Proyecto<br>
Prácticas de Gobierno Abierto para los ODS<br>
PNUD - México<br>

@component('mail::button', ['url' => $url_results])
Ir a los resultados
@endcomponent


@endcomponent
