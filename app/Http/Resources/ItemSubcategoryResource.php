<?php

namespace App\Http\Resources;

use App\Models\ItemCategory;
use Database\Seeders\ItemCategorySeeder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSubcategoryResource extends JsonResource
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
            'item_category' => new ItemCategoryResource($this->item_category),
        ];
    }
}
