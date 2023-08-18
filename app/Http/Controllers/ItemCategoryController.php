<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemCategoryRequest;
use App\Http\Requests\UpdateItemCategoryRequest;
use App\Http\Resources\ItemCategoryResource;
use App\Models\ItemCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;


class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('ItemCategories/Index', [
            'filters' => Request::all('search'),
            'itemCategories' => ItemCategoryResource::collection(
                ItemCategory::orderBy('name')
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
        return Inertia::render('ItemCategories/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemCategoryRequest $request): RedirectResponse
    {
        $itemCategory = ItemCategory::create($request->validated());

        return Redirect::route('item-categories.index')->with('toast', 'Categoria de Articulo Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemCategory $itemCategory): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemCategory $itemCategory): Response
    {
        return Inertia::render('ItemCategories/Edit', [
            'itemCategory' => new ItemCategoryResource($itemCategory),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemCategoryRequest $request, ItemCategory $itemCategory): RedirectResponse
    {
        $itemCategory->update($request->validated());
        return Redirect::route('item-categories.index')->with('toast', 'Categoria de Articulo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemCategory $itemCategory): RedirectResponse
    {
        $itemCategory->delete();

        sleep(1);

        return Redirect::route('item-categories.index');
    }
}
