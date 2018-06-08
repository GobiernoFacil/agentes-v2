@component('mail::message')
Estimado/a {{$user->name}},<br>

Usted cuenta con una nueva retroalimentación para el trabajo de la actividad: <br>
<strong>"{{$activity->name}}"</strong><br>
Para visualizarla, entra a la plataforma.<br>

Saludos

@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
