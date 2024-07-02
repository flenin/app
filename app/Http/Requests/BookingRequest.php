<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'step' => 'required|integer|between:0,4',
            'from_location' => 'required_if:step,0,4',
            'to_location' => 'required_if:step,0,4|different:from_location',
            'voucher' => 'nullable|exists:vouchers,code',
            'custom_amount' => 'nullable|integer|between:1,1000',
            'from_date' => 'required_if:step,2,4|date_format:Y-m-d',
            'from_time' => 'required_if:step,3,4|date_format:H:i',
            'adults' => 'required_if:step,3,4|integer|between:0,7',
            'children' => 'required_if:step,3,4|integer|between:0,7',
            'luggages' => 'required_if:step,3,4|integer|between:0,7',
            'name' => 'required_if:step,3,4|max:20',
            'phone' => 'required_if:step,3,4|max:20',
        ];
    }
}
