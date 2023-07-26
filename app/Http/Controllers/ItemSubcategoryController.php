<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemSubcategoryRequest;
use App\Http\Requests\UpdateItemSubcategoryRequest;
use App\Models\ItemSubcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ItemSubcategoryController extends Controller
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
    public function store(StoreItemSubcategoryRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemSubcategory $itemSubcategory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemSubcategory $itemSubcategory): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemSubcategoryRequest $request, ItemSubcategory $itemSubcategory): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemSubcategory $itemSubcategory): RedirectResponse
    {
        //
    }
}
