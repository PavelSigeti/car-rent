<?php

namespace App\Http\Requests;

use App\Rules\CarPriceDateOverlapRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CarPriceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $carId = $this->id;
        $from = htmlspecialchars($this->start);
        $to = htmlspecialchars($this->end);

        return [
            'price' => 'required|integer',
            'price2' => 'required|integer',
            'price3' => 'required|integer',
            'start' => [
                'required',
                'date',
                new CarPriceDateOverlapRule($carId, $from, $to),

            ],
            'end' => 'required|date|after:start',
        ];
    }
}
