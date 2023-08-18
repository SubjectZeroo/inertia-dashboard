<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerLocationResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerTypeResource;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Customers/Index', [
            'filters' => Request::all('search'),
            'customers' => CustomerResource::collection(
                Customer::orderBy('name')
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
        return Inertia::render('Customers/Create',[
            'customer_types' => CustomerTypeResource::collection(CustomerType::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {

        $customer = Customer::create([
            'name' => $request->name,
            'identification' => $request->identification,
            'email' => $request->email,
            'customer_type_id' => $request->customer_type_id
        ]);

        return Redirect::route('customers.index')->with('toast', 'Cliente Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): Response
    {
        $customer->load(['customer_type']);
        return Inertia::render('Customers/Edit', [
            'customer' => new CustomerResource($customer),
            'customer_types' => CustomerTypeResource::collection(CustomerType::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());
        return Redirect::route('customers.index')->with('toast', 'Cliente Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        sleep(1);

        return Redirect::route('customer.index');
    }
}
