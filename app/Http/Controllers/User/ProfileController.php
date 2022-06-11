<?php

namespace App\Http\Controllers\User;

use \Stripe\Stripe;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Donation;
use App\Traits\Friendable;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Stripe\Checkout\Session;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use Friendable;


    /**
     * Display the specified resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request, User $user) {

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

      $posts = Post::where('parent_id', $user->id)
            ->orWhere('user_id', $user->id)
            ->where('parent_id', null)
            ->latest()
            ->paginate(5);
        if ($request->wantsJson()) {
            return $posts;
        }

        // $session = \Stripe\Checkout\Session::create([
        //     'payment_method_types' => ['card'],
        //     'line_items' => [[
        //         'price_data' => [
        //           'currency' => 'eur',
        //           'product_data' => [
        //             'name' => 'DevTea micro-payment',
        //           ],
        //           'unit_amount' => 200,
        //         ],
        //         'quantity' => 1,
        //       ]],
        //       'mode' => 'payment',
        //       'success_url' => route('profiles.show', auth()->user()->username),
        //       'cancel_url' => route('dashboard.index'),
        //     ]);

        return Inertia::render('User/Profile/Show', [
            'profile' => $user,
            'posts' => $posts,
            'subscription' => $subscription,
            'isFriendsWith' => auth()->user()->is_friends_with($user->id),
            'friendRequestSentTo' => auth()->user()->has_pending_friend_request_sent_to($user->id),
            'friendRequestReceivedFrom' => auth()->user()->has_pending_friend_request_from($user->id),
            //'checkoutSessionId' => $session->id,
        ]);
    }
 
}
