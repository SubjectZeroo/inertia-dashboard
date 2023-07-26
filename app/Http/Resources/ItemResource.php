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
            'units' => UnitResource::collection($this->whenLoaded('units')),
            'item_brands' => ItemBrandResource::collection($this->whenLoaded('item_brands')),
            'item_categories' => ItemCategoryResource::collection($this->whenLoaded('item_categories')),
        ];
    }
}
