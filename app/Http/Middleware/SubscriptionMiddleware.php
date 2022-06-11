<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $hasSubscription = DB::table('subscriptions')
            ->where('user_id', auth()->user()->id)->where('status', 'active')
            ->exists();
            
        if (!$hasSubscription) {
            return Inertia::render('User/NotAuthorized/Index', []);
        }

        return $next($request);
    }
}
