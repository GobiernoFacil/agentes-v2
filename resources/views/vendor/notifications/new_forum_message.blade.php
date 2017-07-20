@component('mail::message')
@if($user->type==='fellow')
Estimado/a {{$user->name." ".$user->fellowData->surname." ".$user->fellowData->lastname}},<br>
@elseif($user->type==='facilitador')
Estimado/a {{$user->name." ".$user->FacilitatorData->surname." ".$user->FacilitatorData->lastname}},<br>
@else
Estimado/a {{$user->name}},<br>
@endif

@if($type==='create')
Se ha creado un nuevo foro <strong>"{{$forum->topic}}"</strong>,<br>
Para visualizarlo e interactuar, entra a la plataforma.
@elseif($type==='question')
El foro <strong>"{{$forum->topic}}"</strong> cuenta con una nueva pregunta:  <br>
<strong>{{$conversation->topic}}</strong>,<br>
Para responder, entra a la plataforma.<br>
@else
La pregunta <strong>"{{$conversation->topic}}"</strong> cuenta con una nueva respuesta en el foro <strong>"{{$forum->topic}}"</strong>,<br>
Para verla, entra a la plataforma.
@endif


Saludos

@component('mail::button', ['url' => $url])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
