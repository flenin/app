<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class PriceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'from_location_id' => $this->from_location_id,
            'to_location_id' => $this->to_location_id,
            'amount' => $this->amount,
            'format' => Number::currency($this->amount, 'EUR', 'fr'),
        ];
    }
}
