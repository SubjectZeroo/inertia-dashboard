<?php

namespace App\Http\Resources;

use App\Models\VehicleBrand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'unit' => $this->unit,
            'serial' => $this->serial,
            'price' => $this->price,
            'customers' => CustomerResource::collection($this->whenLoaded('customers')),
            'vehicle_brands' => VehicleBrand::collection($this->whenLoaded('vehicle_brands')),
            'vehicle_models' => VehicleModel::collection($this->whenLoaded('vehicle_models')),
        ];
    }
}
