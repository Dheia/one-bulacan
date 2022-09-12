<?php

namespace App\Http\Requests\BusinessPortal;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessRequest extends FormRequest
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
        return [
            // 'name' => 'required|max:255|unique:businesses,name,'.$this->id.',id',
            'name' => 'required|max:255',
            'nature' => 'nullable|min:4|string',
            'slug' => 'nullable|max:255',
            'email' => 'required|email',
            'contact_person' => 'required|string||max:255|min:3',
            'website' => 'nullable|url',
            // ContactNumber
            'mobile' => 'required|digits:11',
            'telephone' => 'nullable|numeric',
            // Address 1
            'location_id' =>  'required|min:1',
            'baranggay_id' =>  'required|min:1',
            'address1' => 'required|min:2',
             // Address 2
            'location_id2' =>  'nullable|min:1',
            'baranggay_id2' =>  'nullable|min:1',
            'lot_num2' => 'nullable|min:2',
            // Social Media
            'facebook' => 'nullable|url',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            // CompanyProfile
            'business_history' =>  'nullable',
            'business_description' =>  'nullable',
            'about' =>  'nullable',
            'purpose' =>  'nullable',
            'mission' =>  'nullable',
            'vission' =>  'nullable',
            'core_values' =>  'nullable',
            'business_goals' =>  'nullable',
            'key_process' =>  'nullable',
            'product_services' =>  'nullable',

            'image_gallery' =>  'nullable',
            'ad_promotion' =>  'nullable',
            // GEO
            'latitude' =>  'nullable|max:255',
            'longitude' =>  'nullable|max:255',

            'branches' =>  'nullable',
            'business_category' =>  'required',
            'category_id' =>  'required',
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
