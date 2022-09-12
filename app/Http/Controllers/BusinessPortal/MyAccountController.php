<?php

namespace App\Http\Controllers\BusinessPortal;

use Alert;
use App\Http\Requests\BusinessPortal\AccountInfoRequest;
use App\Http\Requests\BusinessPortal\ChangePasswordRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    protected $data = [];

    /**
     * Show the user a form to change his personal information & password.
     */
    public function getAccountInfoForm()
    {
        $imageField = ([
            'name' => 'image',
            'label' => 'Imagge',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
             'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);
        $this->data['imageField']   = $imageField;
        $this->data['user']         = $this->guard()->user();
        $this->data['title']        = trans('backpack::base.my_account');

        return view(backpack_view('businessPortal.my_account'), $this->data);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $result = $this->guard()->user()->businessOwner->update($request->except(['_token']));

        if ($result) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $user = $this->guard()->user();
        $user->is_first_time_login = 0;
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth()->guard('business-portal');
    }
}
