<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class CountryController extends Controller
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
    public function store(StoreCountryRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country): RedirectResponse
    {
        //
    }
}
