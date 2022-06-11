<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $members = User::notAuthUser($user)->paginate(5);

        if($request->wantsJson()){
            return $members;
        }
        return Inertia::render('User/Explore/Index', [
            'members' => $members
        ]);
    }
}
