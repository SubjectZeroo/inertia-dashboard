<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'price' => $this->price,
            'cost' => $this->cost,
            'unit' => new UnitResource($this->unit),
            'item_brand' => new ItemBrandResource($this->item_brand),
            'item_category' => new ItemCategoryResource($this->item_category),
        ];
    }
}
