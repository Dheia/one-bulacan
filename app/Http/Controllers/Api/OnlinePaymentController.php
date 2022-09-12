<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Validator;

// Controller
use App\Http\Controllers\PaynamicsController;

// Mail
use Mail;
use App\Mail\PaymentInstructionMail;

// Models
use App\Models\PaymentMethod;
use App\Models\PaymentCategory;
use App\Models\PaynamicsPayment;
use App\Models\Business;

class OnlinePaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GET PAYMENT CATEGORIES
    |--------------------------------------------------------------------------
    */
    public function getPaymentCategories()
    {
        $paymentCategories = PaymentCategory::with(['paymentMethods' => function ($query) {
                $query->active();
                // $query->active()->select('id', 'payment_category_id', 'active');
            }])->whereRelation('paymentMethods', 'active', 1)
            ->active()
            ->get();

        return response()->json(['paymentCategories' => $paymentCategories]);
    }

    /*
    |--------------------------------------------------------------------------
    | GET PAYMENT METHOD
    |--------------------------------------------------------------------------
    */
    public function getPaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::active()->where('id', $id)->first();
        return $paymentMethod ? response()->json($paymentMethod) : response()->json(['message' => 'Payment Method Not found'], 400);
    }

    /*
    |--------------------------------------------------------------------------
    | GET PAYMENT HISTORY
    |--------------------------------------------------------------------------
    */
    public function paymentHistory()
    {
        $user               =   auth()->user();
        $payment_histories  =   PaynamicsPayment::where('email', $user->email)->get(); 
        return response()->json(['payment_histories' => $payment_histories]);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT PAYMENT
    |--------------------------------------------------------------------------
    */
    public function validatePaymentQR($slug)
    {
        $business = Business::where('slug', $slug)->published()->active()->first();
        if(! $business) { 
            return response()->json(['message' => 'Business Not Found.'], 404); 
        }

        $paybiz_wallet = $business->paybizWallet;
        if(! $paybiz_wallet) { 
            return response()->json(['message' => 'Business Online Payment Not Set'], 404); 
        }

        return response()->json($business);
        // return Business::generatePaymentQr($business->slug);
    }

    /*
    |--------------------------------------------------------------------------
    | SUBMIT PAYMENT
    |--------------------------------------------------------------------------
    */
    public function submitPayment(Request $request, $business_slug)
    {
        // Validate Input Data
        $validator  =   Validator::make($request->all(), [
            'business_id' => 'required|exists:businesses,id,active,1,drafted,0,deleted_at,NULL',
            'payment_method_id' => 'required|exists:payment_methods,id,active,1,deleted_at,NULL',
            'firstname' => 'required|min:1',
            'lastname'  => 'required|min:1',

            'address'   => 'required|min:5',
            'email'     => 'required|email',
            'mobile'    => 'required|digits:11',
            'description' => 'nullable|string|max:225',

            'amount' => 'required|numeric|min:1',
            'fee'    => 'required',
            'total_amount' => 'required'
        ]);

        // If Validation Failed
        if ($validator->fails()) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors(),
            ];
            return response($response, 422);
        }

        // Get The Selected Business
        $business       = Business::where('id', $request->business_id)
                            ->where('slug', $business_slug)
                            ->published()
                            ->active()
                            ->first();

        // Get The Selected Payment Method
        $paymentMethod  = PaymentMethod::where('id', $request->payment_method_id)->active()->first();

        // Validate Business
        if(! $business) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['business_id' => 'The selected business id is invalid.']
            ];
            return response($response, 422);
        }

        // Validate Business Paybiz
        if(! $business->paybizWallet) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['business_id' => 'The selected business online payment is not yet set.']
            ];
            return response($response, 422);
        }

        if(! $business->paybizWallet->active) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['business_id' => 'The selected business online payment is not yet set.']
            ];
            return response($response, 422);
        }

        // Validate Payment Method Category
        if(! $paymentMethod->paymentCategory) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['payment_method_id' => 'The selected payment method is invalid.']
            ];
            return response($response, 422);
        }

        if(! $paymentMethod->paymentCategory->active) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['payment_method_id' => 'The selected payment method is invalid.']
            ];
            return response($response, 422);
        }

        /** 
         * INITIALIZE THE PAYNAMICS DATA
         */
        $paynamics      = new PaynamicsController();
        $payment_data   = $paynamics->initialize($business, $paymentMethod, $request->input());

        // Error Initialization
        if($payment_data['status'] != 'success') {
            if(! $payment_data['message'] ) {
                $response = [
                    'message' => 'Something went wrong, please reload the page.'
                ];
                return response($response, 422);
            }
            $response = [
                'message' => $payment_data['message']
            ];
            return response($response, 422);
        }

        /** 
         * CREATE PAYNAMICS PAYMENT
         */
        $createPayment = $paynamics->createPayment($payment_data['data']);

        // Error Paynamics Payment Creation
        if($createPayment['status'] != 'success') {
            if(! $createPayment['message'] ) {
                $response = [
                    'message' => 'Something went wrong, please reload the page.'
                ];
                return response($response, 422);
            }
            $response = [
                'message' => $createPayment['message']
            ];
            return response($response, 422);
        }

        $decoded_data = json_decode($createPayment['data']);

        /** 
         * PAYMENT INSTRUCTION // Check If Direct OTC Info is Array
         */
        if(isset($decoded_data->direct_otc_info)) {
            if(is_array($decoded_data->direct_otc_info)) {
                $payment_instructions = $decoded_data->direct_otc_info[0];

                $data = [
                    'business'       => $business,
                    'paymentMethod'  => $paymentMethod,
                    'amount'         => $payment_data['amount'],
                    'paynamicsPayment'      => $decoded_data,
                    'payment_instructions'  => $payment_instructions
                ];

                try {
                    // Mail To Payer Email
                    ini_set('max_execution_time', 300);
                    Mail::to($request->email)->send(new PaymentInstructionMail($data));
                }  catch (\Exception $e) {
                    \Log::error([
                        'title' => 'Payment Instruction Mail Error',
                        'email' => $request->email,
                        'date'  => Carbon::now()->format('F j, Y - h:i A'),
                        'error' => $e
                    ]);
                }
                $response = [
                    'status'        => 'success',
                    'message'       => $decoded_data->response_message,
                    'amount'        => $payment_data['amount'],
                    'instruction'   => $payment_instructions,
                    'web_url'       => route('online_payment.instructions', ['request_id' => $decoded_data->request_id])
                ];
                return response($response, 201);
                // return Redirect::route('online_payment.instructions', ['request_id' => $decoded_data->request_id]);
            }
            $response = [
                'status'        => 'success',
                'message'       => $decoded_data->response_message,
                'amount'        => $payment_data['amount'],
                'web_url'       => $decoded_data->direct_otc_info
            ];
            return response($response, 201);
            // return redirect()->to($decoded_data->direct_otc_info);
        }

        if(isset($decoded_data->payment_action_info)) {
            if(is_array($decoded_data->payment_action_info)) {
                $payment_instructions = $decoded_data->payment_action_info[0];

                $data = [
                    'business'       => $business,
                    'paymentMethod'  => $paymentMethod,
                    'amount'         => $payment_data['amount'],
                    'payment_instructions'  => $payment_instructions
                ];

                try {
                    // Mail To Payer Email
                    ini_set('max_execution_time', 300);
                    Mail::to($request->email)->send(new PaymentInstructionMail($data));
                }  catch (\Exception $e) {
                    \Log::error([
                        'title' => 'Payment Instruction Mail Error',
                        'email' => $request->email,
                        'date'  => Carbon::now()->format('F j, Y - h:i A'),
                        'error' => $e
                    ]);
                }

                $response = [
                    'status'        => 'success',
                    'message'       => $decoded_data->response_message,
                    'amount'        => $payment_data['amount'],
                    'instruction'   => $payment_instructions,
                    'web_url'       => route('online_payment.instructions', ['request_id' => $decoded_data->request_id])
                ];
                return response($response, 201);
                // return Redirect::route('online_payment.instructions', ['request_id' => $decoded_data->request_id]);
            }
        }

        $response = [
            'status'        => 'success',
            'message'       => $decoded_data->response_message,
            'amount'        => $payment_data['amount'],
            'web_url'       => $decoded_data->direct_otc_info ?? $decoded_data->payment_action_info
        ];
        return response($response, 201);
    }
}
