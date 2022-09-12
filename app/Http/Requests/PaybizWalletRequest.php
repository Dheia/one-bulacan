<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaybizWalletRequest extends FormRequest
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
            'business_id'   => 'required|unique:paybiz_wallets,business_id,' . $this->id . ',id,deleted_at,NULL|exists:businesses,id,deleted_at,NULL',
            'biz_wallet_id' => 'required|unique:paybiz_wallets,biz_wallet_id,' . $this->id . ',id,deleted_at,NULL',
            'descriptor_note' => 'required|min:0|max:24',
            'minimum_amount' => 'required|numeric|min:0'
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
