<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_category_id'  => 'required|exists:payment_categories,id,active,1,deleted_at,NULL',
            'name' => 'required',
            'code' => 'required',
            'icon' => 'nullable',
            'logo' => 'nullable',
            'description' => 'nullable',
            'fee' => 'required',
            'additiona_fee' => 'nullable',
            'minimum_fee' => 'nullable',
            'fee' => 'required',
            'additional_fee' => 'nullable'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
