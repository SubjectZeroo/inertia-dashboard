<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\StoreItemSubcategoryRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemBrandResource;
use App\Http\Resources\ItemCategoryResource;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemSubcategoryResource;
use App\Http\Resources\UnitResource;
use App\Models\Item;
use App\Models\ItemBrand;
use App\Models\ItemCategory;
use App\Models\ItemSubcategory;
use App\Models\Unit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
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
            'item_subcategories' => ItemSubcategoryResource::collection(ItemSubcategory::all()),
            'item_brands' => ItemBrandResource::collection(ItemBrand::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request): RedirectResponse
    {
        $item = Item::create($request->validated());

        return Redirect::route('items.index')->with('toast', 'Item Creado');
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
        $item->load(['unit', 'item_category', 'item_brand']);

        return Inertia::render('Items/Edit', [
            'item' => new ItemResource($item),
            'units' => UnitResource::collection(Unit::all()),
            'item_categories' => ItemCategoryResource::collection(ItemCategory::all()),
            'item_subcategories' => ItemSubcategoryResource::collection(ItemSubcategory::all()),
            'item_brands' => ItemBrandResource::collection(ItemBrand::all())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item): RedirectResponse
    {
        $item->update($request->validated());

        return Redirect::route('items.index')->with('toast', 'Item Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        sleep(1);

        return Redirect::route('items.index');
    }
}
