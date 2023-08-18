<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVehicleModelRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleModelRequest;
use App\Http\Resources\VehicleBrandResource;
use App\Http\Resources\VehicleModelResource;
use App\Http\Resources\VehicleTypeResource;
use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Reques;
use Illuminate\Http\Request as HttpRequest;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('VehicleModels/Index', [
            'filters' => Request::all('search'),
            'vehicleModels' => VehicleModelResource::collection(
                VehicleModel::orderBy('name')
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
        return Inertia::render('VehicleModels/Create', [
            'vehicle_brands' => VehicleBrandResource::collection(VehicleBrand::all()),
            'vehicle_types' => VehicleTypeResource::collection(VehicleType::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVehicleModelRequest $request): RedirectResponse
    {
        $vehicleModel = VehicleModel::create($request->validated());

        return Redirect::route('vehicle-models.index')->with('toast', 'Modelo de Vehiculo Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleModel $vehicleModel): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleModel $vehicleModel): Response
    {

        $vehicleModel->load(['vehicle_brand', 'vehicle_type']);

        return Inertia::render('VehicleModels/Edit', [
            'vehicleModel' => new VehicleModelResource($vehicleModel),
            'vehicle_brands' => VehicleBrandResource::collection(VehicleBrand::all()),
            'vehicle_types' => VehicleTypeResource::collection(VehicleType::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleModelRequest $request, VehicleModel $vehicleModel): RedirectResponse
    {
        $vehicleModel->update($request->validated());
        return Redirect::route('vehicle-models.index')->with('toast', 'Modelo de Vehiculo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $vehicleModel): RedirectResponse
    {
        $vehicleModel->delete();

        sleep(1);

        return Redirect::route('vehicle-models.index');
    }

    public function getModelsByBrand(HttpRequest $request)
    {
        // dd($request->all());
        $vehicle_models = VehicleModel::where('vehicle_brand_id', $request->vehicle_brand_id)->get();

        return $vehicle_models;
    }
}
