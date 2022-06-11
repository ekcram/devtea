<?php

// namespace Laravel\Jetstream\Http\Controllers\Inertia;
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Routing\Controller;

class ProfileHeaderPhotoController extends Controller
{
    /**
     * Delete the current user's profile photo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->deleteProfileHeaderPhoto();

        return back(303)->with('status', 'profile-header-photo-deleted');
    }
}
