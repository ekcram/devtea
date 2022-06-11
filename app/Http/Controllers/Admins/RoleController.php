<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RoleController extends Controller
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
        
        $query = Role::query();

        // Si tenemos un rol que permite el acceso a los Roles (en Policies/RolesPolicy/accessRoles), nos lo mostrará. De lo contrario nos devuelve a la vista principal.
        if (Gate::allows('accessRoles')) {

            if (request('search')) {
                $query->where('name', 'LIKE', '%'.request('search').'%');
            }

            if (request()->has(['field', 'direction'])) {
                $query->orderBy(request('field'), request('direction'));
            }
     
            return Inertia::render('Admin/Roles/Index', [
                'roles' => $query->paginate(8)->withQueryString(),
                'filters' => request()->all(['search', 'field', 'direction'])
            ]);
        }

        return back();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Si tenemos un rol que permite gestionar los Roles (en Policies/RolesPolicy/manageRoles), nos lo mostrará. De lo contrario nos devuelve a la vista principal.
        if (Gate::allows('manageRoles')) {
            return Inertia::render('Admin/Roles/Index');
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::allows('manageRoles')) {
            $request->validate([
                'name' => 'required'
            ]);

            Role::create($request->only(['name']));
            return redirect(route('admin.roles.index'))->withSuccess('Rol creado correctamente');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (Gate::allows('accessRoles')) {
            return Inertia::render('Admin/Roles/Edit', [
                'role' => $role
            ]);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        if (Gate::allows('manageRoles')) {
            $request->validate([
                'name' => 'required'
            ]);
            $role->update($request->only(['name']));

            return redirect(route('admin.roles.index'))->withSuccess('Rol actualizado correctamente');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (Gate::allows('manageRoles')) {
            $role->delete();
            return redirect(route('admin.roles.index'))->withSuccess('Rol eliminado correctamente');
        }
        return back();
    }
}
