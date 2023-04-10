<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PlaceUpdateRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'title' => 'required|string',
            'delivery_price' => 'required|integer',
            'extra_price' => 'nullable|integer',
            'small_text' => 'nullable|string',
            'big_text' => 'nullable|string',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'slug' => 'required',
            'min_days' => 'nullable|integer',
            'min_days_price' => 'nullable|integer',

        ];
    }
}
