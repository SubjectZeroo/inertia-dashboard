<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemBrandResource;
use App\Http\Resources\ItemCategoryResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\UnitResource;
use App\Models\Item;
use App\Models\ItemBrand;
use App\Models\ItemCategory;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ItemController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Items/Index', [
            'filters' => Request::all('search'),
            'items' => ItemResource::collection(
                Item::orderBy('name')
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
        return Inertia::render('Items/Create', [
            'units' => UnitResource::collection(Unit::all()),
            'item_categories' => ItemCategoryResource::collection(ItemCategory::all()),
            'item_brands' => ItemBrandResource::collection(ItemCategory::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item): Response
    {
        return Inertia::render('Items/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        //
    }
}
