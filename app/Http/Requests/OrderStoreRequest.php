<?php

namespace App\Http\Requests;

use App\Rules\OrderDataRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => [
                'required',
                'string',
                new OrderDataRule(),
            ],
            'start_place' => 'required|integer',
            'start_time' => 'required|date_format:H:i',
            'end_place' => 'required|integer',
            'end_time' => 'required|date_format:H:i',
            'service' => 'nullable|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'comment' => 'nullable|string',
            'status' => 'nullable|in:check,work,done'
        ];
    }
}
