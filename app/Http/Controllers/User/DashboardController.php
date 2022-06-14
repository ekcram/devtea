<?php

namespace App\Http\Controllers\User;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * allPosts es la función scopeAllPosts (local scope) que se ha definido dentro de Models/Post.php
     * Documentación: Local Scopes https://laravel.com/docs/9.x/eloquent#query-scopes 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $combinedPosts = Post::where('parent_id', null)->allPosts()->latest()->paginate(5);
        $combinedPosts->setPath('dashboard');
        
        $donations = DB::table('donations')
        ->where('parent_id', auth()->user()->id)
        ->count();

        if ($request->wantsJson()) {
            return $combinedPosts;
        }
        return Inertia::render('Dashboard', [
            'donations' => $donations,
            'combinedPosts' => $combinedPosts,
            'suggestions' => User::suggestions()->take(5)->inRandomOrder()->get(),
        ]);
    }
}
