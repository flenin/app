<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Number;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'location' => new LocationResource($this->location),
            'from_date' => new DateResource($this->whenHas('from_date')),
            'from_time' => new TimeResource($this->whenHas('from_time')),
            'adults' => $this->whenHas('adults'),
            'children' => $this->whenHas('children'),
            'luggages' => $this->whenHas('luggages'),
            'amount' => Number::currency($this->amount ?? 0, 'EUR', 'fr'),
            'amountWithVoucher' => Number::currency($this->amountWithVoucher ?? 0, 'EUR', 'fr'),
            'name' => $this->whenHas('name'),
            'phone' => $this->whenHas('phone'),
            'voucher' => new VoucherResource($this->whenLoaded('voucher')),
            'customAmount' => Number::currency($this->custom_amount ?? 0, 'EUR', 'fr'),
        ];
    }
}
