@component('mail::message')
@if($to_user->type==='fellow')
Estimado/a {{$to_user->name." ".$to_user->fellowData->surname." ".$to_user->fellowData->lastname}},<br>
@elseif($to_user->type==='facilitador')
Estimado/a {{$to_user->name." ".$to_user->FacilitatorData->surname." ".$to_user->FacilitatorData->lastname}},<br>
@else
Estimado/a {{$to_user->name}},<br>
@endif

@if($user->type==='fellow')
Tienes un nuevo mensaje de  {{$user->name." ".$user->fellowData->surname." ".$user->fellowData->lastname}},<br>
@elseif($user->type==='facilitador')
Tienes un nuevo mensaje de  {{$user->name." ".$user->FacilitatorData->surname." ".$user->FacilitatorData->lastname}},<br>
@else
Tienes un nuevo mensaje de  {{$user->name}},<br>
@endif

Para visualizarlo y responderlo, entra a la plataforma.

Saludos

@component('mail::button', ['url' => 'www.apertus.org.mx/login'])
Ir a la plataforma
@endcomponent

¡Saludos!,<br>
<a href="www.apertus.org.mx">{{ config('app.name') }}</a>
@endcomponent
