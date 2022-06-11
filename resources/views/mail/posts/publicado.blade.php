@component('mail::message')
# Alguien ha publicado en tu perfil.

**{{$user->username}}** ha publicado en tu perfil. ¡Ve a verlo!

@component('mail::button', ['url' => route('dashboard.index'), 'color' => 'green'])
Ver publicación
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
