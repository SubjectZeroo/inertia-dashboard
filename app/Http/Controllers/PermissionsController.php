<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequestCreate;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Permissions/Index', [
            'filters' => FacadesRequest::all('search'),
            'permissions' => PermissionResource::collection(
                Permission::filter(FacadesRequest::only('search'))
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
        return Inertia::render('Permissions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequestCreate $request): RedirectResponse
    {
        Permission::create($request->validated());

        return redirect(route('permissions'));
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
    public function edit(Permission $permission): Response
    {
        return Inertia::render('Permissions/Edit', [
            'permission' => [
                'id' => $permission->id,
                'name' => $permission->name,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequestCreate $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->validated());

        return redirect(route('permissions'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect(route('permissions.index'));
    }
}
