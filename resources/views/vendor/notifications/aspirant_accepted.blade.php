@component('mail::message')

{{$aspirant->gender === 'female' ? 'Estimada ' : 'Estimado '}} {{$aspirant->name.' '.$aspirant->surname.' '.$aspirant->lastname}}

Las instituciones convocantes al Programa de Formación de Agentes de Cambio en Gobierno Abierto y Desarrollo Sostenible queremos
<strong>extenderle una felicitación por haber sido seleccionado (a) para participar en el Programa de Formación de Agentes de Cambio en Gobierno Abierto y Desarrollo Sostenible</strong> edición 2018. <br>

<strong>Los resultados de la convocatoria están disponibles en la página {{$url_results}} y su perfil cumple con los requisitos e idoneidad para formar parte del programa</strong>. Le invitamos a
ingresar al sitio electrónico para conocer el resultado de su desempeño durante el proceso de selección, mismo que podrá identificar con su número de folio {{$aspirant->id}}.<br>

En caso de aceptar su postulación para formar parte del Programa de Formación le invitamos a revisar el archivo adjunto que contiene la <strong>Carta Compromiso</strong>,
misma que deberá ser remitida a la dirección <a href="mailto:mariana.garcia@undp.org">mariana.garcia@undp.org</a> <strong>a más tardar el próximo 22 de mayo.</strong><br>

Finalmente, en los próximos días le estaremos informando sobre los siguientes pasos para dar inicio al Programa de Formación por lo que le solicitamos estar
atento a su cuenta de correo electrónico.<br>
Para cualquier duda o comentario, favor de contactar a la Coordinadora de Proyecto “Prácticas de Gobierno Abierto para los ODS” en el PNUD México
en la dirección de correo electrónico <a href="mailto:mariana.garcia@undp.org">mariana.garcia@undp.org</a><br>

A nombre del Comité Dictaminador,<br>

Mariana García<br>
Coordinadora del Proyecto<br>
Prácticas de Gobierno Abierto para los ODS<br>
PNUD - México<br>


@component('mail::button', ['url' => $url_results])
Ir a los resultados
@endcomponent


@endcomponent
