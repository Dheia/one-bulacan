<?php

namespace App\Http\Requests\BusinessPortal;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\ProductService;

class ProductServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return Auth::guard('business-portal')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->user = Auth::guard('business-portal')->user();
        
        return [
            'business_id' => [
                'required',
                Rule::in($this->user->businessOwner->businesses->pluck('id')->toArray()),
            ],
            'name' => 'required|min:5|max:255',
            'description' => 'required|min:5|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable'
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
