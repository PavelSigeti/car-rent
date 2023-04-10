<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CarStoreRequest extends FormRequest
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
            'price' => 'required|integer',
            'price2' => 'required|integer',
            'price3' => 'required|integer',
            'is_published' => 'required|boolean',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
            'seo_text' => 'nullable|string',
            'engine' => 'nullable|integer',
            'meta' => 'required|array',
            'seats' => 'nullable|integer',
            'year' => 'nullable|integer',
            'msg' => 'nullable|string',
            'zalog' => 'nullable|integer',
            'home_place' => 'nullable|integer|min:0',
            'discount' => 'nullable|string|max:32',
        ];
    }
}
