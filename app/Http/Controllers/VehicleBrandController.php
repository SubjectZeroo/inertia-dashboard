<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleBrandRequest;
use App\Http\Requests\UpdateVehicleBrandRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleBrandResource;
use App\Models\VehicleBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
class VehicleBrandController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('VehicleBrands/Index', [
            'filters' => Request::all('search'),
            'vehicleBrands' => VehicleBrandResource::collection(
                VehicleBrand::orderBy('name')
                    ->filter(Request::only('search'))
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
        return Inertia::render('VehicleBrands/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleBrandRequest $request): RedirectResponse
    {
        $vehicleBrand = VehicleBrand::create($request->validated());

        return Redirect::route('vehicle-brands.index')->with('toast', 'Marca de Vehiculo Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleBrand $vehicleBrand): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleBrand $vehicleBrand): Response
    {

        return Inertia::render('VehicleBrands/Edit', [
            'vehicleBrand' => new VehicleBrandResource($vehicleBrand),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleBrandRequest $request, VehicleBrand $vehicleBrand): RedirectResponse
    {
        $vehicleBrand->update($request->validated());
        return Redirect::route('vehicle-brands.index')->with('toast', 'Marca de Vehiculo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleBrand $vehicleBrand): RedirectResponse
    {
        $vehicleBrand->delete();

        sleep(1);

        return Redirect::route('vehicle-brands.index');
    }
}
