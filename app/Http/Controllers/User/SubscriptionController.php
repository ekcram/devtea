<?php

namespace App\Http\Controllers\User;
use Inertia\Inertia;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{

    public function index(Request $request)
    {
        $subscription = Subscription::where('user_id', auth()->id())->first();

        if($subscription === null){
          $subscription = Subscription::create([
                'name' => 'DevTea Premium',
                'type' => 'monthly',
                'user_id' => auth()->id(),
                'payment_id' => null,
                'status' => 'no-active'
            ]);
        } else {
             $subscription;
        }
        
        return Inertia::render('User/Membership/Index', [
            'user' => $request->user(),
            'subscription' => $subscription,
        ]);
    }

    public function checkout(Request $request){
        return Inertia::render('User/Membership/Checkout', [
        ]);
    }
}
