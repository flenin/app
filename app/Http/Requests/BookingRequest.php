<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Validator;

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
            'adults' => 'required_if:step,0,4|integer|between:0,10',
            'children' => 'required_if:step,0,4|integer|between:0,10',
            'voucher' => 'nullable|exists:vouchers,code',
            'from_date' => 'required_if:step,2,4|date_format:Y-m-d',
            'from_time' => 'required_if:step,3,4|date_format:H:i',
            'luggages' => 'required_if:step,3,4|integer|between:0,10',
            'name' => 'required_if:step,3,4|max:20',
            'phone' => 'required_if:step,3,4|max:20',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (($this->adults + $this->children) === 0) {
                    $validator->errors()->add(
                        'adults',
                        __('validation.custom.adults.min')
                    );
                }

                if (($this->adults + $this->children) > 7) {
                    $validator->errors()->add(
                        'adults',
                        __('validation.custom.adults.max')
                    );
                }
            }
        ];
    }
}
