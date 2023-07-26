<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerLocationRequest;
use App\Http\Requests\UpdateCustomerLocationRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CustomerLocationResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\StateResource;
use App\Models\Country;
use App\Models\Customer;
use App\Models\CustomerLocation;
use App\Models\State;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomerLocationController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('CustomerLocations/Index', [
            'filters' => Request::all('search'),
            'customerLocations' => CustomerLocationResource::collection(
                CustomerLocation::orderBy('name')
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
        return Inertia::render('CustomerLocations/Create',[
            'customers' => CustomerResource::collection(Customer::all()),
            'countries' => CountryResource::collection(Country::all()),
            'states' => StateResource::collection(State::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerLocationRequest $request): RedirectResponse
    {

        $customerLocation = CustomerLocation::create([
            'customer_id' => $request->customer_id,
            'state_id' => $request->state_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'ubication' => $request->ubication,
        ]);

        return Redirect::route('customer-locations.index')->with('toast', 'Locacion de Cliente Creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerLocation $customerLocation): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerLocation $customerLocation): Response
    {
        $customerLocation->load(['customer', 'state']);

        return Inertia::render('CustomerLocations/Edit',[
            'customerLocation' => new CustomerLocationResource($customerLocation),
            'customers' => CustomerResource::collection(Customer::all()),
            'countries' => CountryResource::collection(Country::all()),
            'states'=> StateResource::collection(State::all()),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerLocationRequest $request, CustomerLocation $customerLocation): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerLocation $customerLocation): RedirectResponse
    {
        $customerLocation->delete();

        sleep(1);

        return Redirect::route('customer-locations.index');
    }
}
