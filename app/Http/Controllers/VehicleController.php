<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\VehicleBrandResource;
use App\Http\Resources\VehicleModelResource;
use App\Http\Resources\VehicleResource;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Vehicles/Index', [
            'filters' => Request::all('search'),
            'vehicles' => VehicleResource::collection(
                Vehicle::orderBy('unit')
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
        return Inertia::render('Vehicles/Create', [
            'customers' => CustomerResource::collection(Customer::all()),
            'vehicle_brands' => VehicleBrandResource::collection(VehicleBrand::all()),
            'vehicle_models' => VehicleModelResource::collection(VehicleModel::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $vehicle = Vehicle::create($request->validated());

        return Redirect::route('vehicles.index')->with('toast', 'Vehiculo Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle): Response
    {
        $vehicle->load(['customer', 'vehicle_model']);

        return Inertia::render('Vehicles/Edit', [
            'vehicle' => new VehicleResource($vehicle),
            'customers' => CustomerResource::collection(Customer::all()),
            'vehicle_brands' => VehicleBrandResource::collection(VehicleBrand::all()),
            'vehicle_models' => VehicleModelResource::collection(VehicleModel::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $vehicle->update($request->validated());
        return Redirect::route('vehicles.index')->with('toast', 'Vehiculo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();

        sleep(1);

        return Redirect::route('vehicles.index');
    }
}
