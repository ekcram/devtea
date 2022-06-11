<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SolicitudAmistadAceptadaEvent;
use App\Events\SolicitudAmistadRecibidaEvent;
//use App\Notifications\SolicitudAmistadRecibida;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return Inertia::render('User/Friends/Index', [
            'friends' => auth()->user()->friends(),
            'requests' => auth()->user()->pending_friend_requests(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'No se ha podido encontrar el usuario.']);
        }
        auth()->user()->add_friend($user->id);
        event(new SolicitudAmistadRecibidaEvent($user));
        // $authUser = auth()->user();
        // $user->notify(new SolicitudAmistadRecibida($authUser));
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'No se ha podido encontrar el usuario.']);
        }
        auth()->user()->accept_friend($user->id);
        event(new SolicitudAmistadAceptadaEvent($user));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'No se ha podido encontrar el usuario.']);
        }
        auth()->user()->delete_friend($user->id);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function deny(User $user) {
        if (!$user) {
            return back()->withErrors(['message' => 'No se ha podido encontrar el usuario.']);
        }
        auth()->user()->deny_friend($user->id);
        return back();
    }
}