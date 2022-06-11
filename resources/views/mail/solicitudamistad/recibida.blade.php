@component('mail::message')
# Solicitud de amistad

**Has recibido una solicitud de amistad de:** {{$user->name}} {{$user->surname}} ({{$user->username}})
**Puedes acceder a su perfil pulsando en el botón.**   

@component('mail::button', ['url' => route('profiles.show', $user->username), 'color' => 'green'])
Visitar perfil
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
