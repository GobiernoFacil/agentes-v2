@component('mail::message')
Estimado/a {{$user->name}},<br>


Tienes un nuevo aviso,<br>
<h1>{{$notice->title}}</h1>
<strong>{{$notice->brief}}</strong><br>
Para visualizarlo, entra a la plataforma.

Saludos

@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
