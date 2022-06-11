<?php

namespace App\Http\Controllers\Admins;

use Inertia\Inertia;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = DB::table('users')->where('is_admin', '=', '1')->count();
        $users = DB::table('users')->where('is_admin', '=', '0')->count();
        $roles = DB::table('roles')->count();
        $usersSubscribed = DB::table('subscriptions')->where('status', '=', 'active')->count();
        $devteas =  Donation::sum('amount');
        $totalSubscriptions = DB::table('payments')->where('payment_type', '=', 'subscription')->sum('price');
        return Inertia::render('Admin/Dashboard', [
            'admins' => $admins,
            'users' => $users,
            'roles' => $roles,
            'usersSubscribed' => $usersSubscribed,
            'totalDonations' => $devteas,
            'totalSubscriptions' => $totalSubscriptions,
        ]);
    }

}
