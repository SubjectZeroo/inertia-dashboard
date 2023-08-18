<?php

namespace App\Http\Resources;

use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'identification' => $this->identification,
            'email' => $this->email,
            'customer_type' => new CustomerTypeResource($this->customer_type),
        ];
    }
}
