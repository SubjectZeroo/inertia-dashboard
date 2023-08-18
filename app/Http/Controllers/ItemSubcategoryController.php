<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemSubcategoryRequest;
use App\Http\Requests\UpdateItemSubcategoryRequest;
use App\Http\Resources\ItemCategoryResource;
use App\Http\Resources\ItemSubcategoryResource;
use App\Models\ItemCategory;
use App\Models\ItemSubcategory;
use Database\Seeders\ItemSubcategorySeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
class ItemSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('ItemSubcategories/Index', [
            'filters' => Request::all('search'),
            'itemSubcategories' => ItemSubcategoryResource::collection(
                ItemSubcategory::orderBy('name')
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
        return Inertia::render('ItemSubcategories/Create', [
            'item_categories' => ItemCategoryResource::collection(ItemCategory::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemSubcategoryRequest $request): RedirectResponse
    {
        $itemSubcategory = ItemSubcategory::create($request->validated());

        return Redirect::route('item-subcategories.index')->with('toast', 'SubCategoria de Articulo Creado');
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
        $itemSubcategory->load(['item_category']);
        return Inertia::render('ItemSubcategories/Edit', [
            'itemSubcategory' => new ItemSubcategoryResource($itemSubcategory),
            'item_categories' => ItemCategoryResource::collection(ItemCategory::all()),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemSubcategoryRequest $request, ItemSubcategory $itemSubcategory): RedirectResponse
    {
        $itemSubcategory->update($request->validated());
        return Redirect::route('item-subcategories.index')->with('toast', 'Subcategoria de Articulo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemSubcategory $itemSubcategory): RedirectResponse
    {
        $itemSubcategory->delete();

        sleep(1);

        return Redirect::route('item-subcategories.index');
    }

    public function getSubcategoryByCategory(Request $request)
    {
        $item_subcategories = ItemSubcategory::where('item_category_id', $request->item_category_id)->get();

        return $item_subcategories;
    }
}
