@component('mail::message')
# Solicitud de amistad aceptada

**Tu solicitud de amistad ha sido aceptada por**  {{$user->name}} {{$user->surname}} ({{$user->username}})

@component('mail::button', ['url' => route('profiles.show', $user->username), 'color' => 'green'])
Visitar perfil
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
