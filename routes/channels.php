<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('doubt.{doubtId}', function ($user, $doubtId) {
    if(Auth::check()) {
        return [
            'username' => $user->username,
            'avatar' => $user->profile_photo_url,
        ];
    }
});

Broadcast::channel('chat.{chatId}', function ($user, $chatId) {
    if(Auth::check()) {
        return [
            'username' => $user->username,
            'avatar' => $user->profile_photo_url,
        ];
    }
});
