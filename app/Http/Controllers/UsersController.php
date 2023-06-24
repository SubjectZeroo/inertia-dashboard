<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequestCreate;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // dd(User::orderBy('name')->paginate(10));
        return Inertia::render('Users/Index', [
            'filters' => FacadesRequest::all('search'),
            'users' => UserResource::collection(
                User::orderBy('name')
                    ->filter(FacadesRequest::only('search'))
                    ->paginate(10)
                    ->withQueryString()
            )
            // 'users' => User::orderBy('name')
            //     ->filter(Request::only('search'))
            //     ->paginate(10)
            //     ->withQueryString()
            //     ->through(fn ($user) => [
            //         'id' => $user->id,
            //         'name' => $user->name,
            //         'email' => $user->email,
            //     ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Users/Create', [
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequestCreate $request): RedirectResponse
    {

        // Request::validate([
        //     'name' => ['required', 'max:50'],
        //     'email' => ['required', 'max:50', 'email', Rule::unique('users')],
        //     'password' => ['nullable'],
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $user->syncRoles($request->input('roles.*.name'));
        $user->syncPermissions($request->input('permissions.*.name'));

        return Redirect::route('users.index')->with('toast', 'Usuario Creado');
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
    public function edit(User $user): Response
    {
        $user->load(['roles', 'permissions']);
        return Inertia::render('Users/Edit', [
            'user' => new UserResource($user),
            'roles' => RoleResource::collection(Role::all()),
            'permissions' => PermissionResource::collection(Permission::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequestCreate $request, User $user): RedirectResponse
    {

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles($request->input('roles.*.name'));

        $user->syncPermissions($request->input('permissions.*.name'));

        return Redirect::route('users.index')->with('toast', 'Usuario Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        sleep(1);

        return Redirect::route('users.index');
    }
}
