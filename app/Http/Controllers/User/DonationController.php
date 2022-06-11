<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function checkout(Request $request, User $user){
        return Inertia::render('User/Profile/Checkout', [
            'profile' => $user,
        ]);
    }
}
