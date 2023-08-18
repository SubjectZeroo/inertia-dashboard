<?php

namespace App\Http\Resources;

use App\Models\Country;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerLocationResource extends JsonResource
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
            'phone' => $this->phone,
            'address' => $this->address,
            'ubication' => $this->ubication,
            'customer' => new CustomerResource($this->customer),
            'state' => new StateResource($this->state)
        ];
    }
}
