<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,city']
        ]);
        
        $query = User::query()->where('is_admin', 0);

        if (Gate::allows('accessUsers')) {

            if (request('search')) {
                $query->where('name', 'LIKE', '%'.request('search').'%')
                ->orWhere('surname', 'LIKE', '%'.request('search').'%')
                ->orWhere('username', 'LIKE', '%'.request('search').'%')
                ->orWhere('email', 'LIKE', '%'.request('search').'%');
                
            }

            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
     
            return Inertia::render('Admin/Users/Index', [
                'users' => $query->paginate(8)->withQueryString()->setPath('users'),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::allows('manageUsers')) {
            return Inertia::render('Admin/Users/Edit', [
                'user' => $user,
                'allRoles' => Role::all()
            ]);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Gate::allows('manageUsers')) {
             $user->update([
                    'name' =>  $request->name,
                    'email' => $request->email,
                ]);
            return redirect()->route('admin.users.index')->withSuccess(ucwords($user->name) . ' has been successfully updated!');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
