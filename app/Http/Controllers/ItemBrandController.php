<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemBrandRequest;
use App\Http\Requests\UpdateItemBrandRequest;
use App\Http\Resources\ItemBrandResource;
use App\Models\ItemBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;

class ItemBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('ItemBrands/Index', [
            'filters' => Request::all('search'),
            'itemBrands' => ItemBrandResource::collection(
                ItemBrand::orderBy('name')
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
        return Inertia::render('ItemBrands/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemBrandRequest $request): RedirectResponse
    {
        $itemBrand = ItemBrand::create($request->validated());

        return Redirect::route('item-brands.index')->with('toast', 'Marca de Articulo Creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemBrand $itemBrand): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemBrand $itemBrand): Response
    {
        // dd($itemBrand);
        return Inertia::render('ItemBrands/Edit', [
            'itemBrand' => new ItemBrandResource($itemBrand),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemBrandRequest $request, ItemBrand $itemBrand): RedirectResponse
    {
        $itemBrand->update($request->validated());
        return Redirect::route('item-brands.index')->with('toast', 'Marca de Articulo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemBrand $itemBrand): RedirectResponse
    {
        $itemBrand->delete();

        sleep(1);

        return Redirect::route('item-brands.index');
    }
}
