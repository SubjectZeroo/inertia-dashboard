<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerTypeRequest;
use App\Http\Requests\UpdateCustomerTypeRequest;
use App\Models\CustomerType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerTypeRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerType $customerType): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerType $customerType): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerTypeRequest $request, CustomerType $customerType): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerType $customerType): RedirectResponse
    {
        //
    }
}
