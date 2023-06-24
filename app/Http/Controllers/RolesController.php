<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Roles/Index', [
            'filters' => FacadesRequest::all('search'),
            'roles' => RoleResource::collection(
                Role::filter(FacadesRequest::only('search'))
                    ->paginate(10)
                    ->withQueryString()
            )
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Roles/Create', [
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->input('permissions.*.name'));
        }

        return Redirect::route('roles.index')->with('toast', 'Rol Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): Response
    {
        $role->load('permissions');
        return Inertia::render('Roles/Edit', [
            'role' => new RoleResource($role),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->input('permissions.*.name'));

        return Redirect::route('roles.index')->with('toast', 'Rol Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        return redirect(route('roles.index'));
    }
}
