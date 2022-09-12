<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;

use App\Http\Controllers\PaynamicsController;

// Mail
use Mail;
use App\Mail\PaymentInstructionMail;

// Models
use App\Models\PaynamicsPayment;
use App\Models\PaymentCategory;
use App\Models\PaymentMethod;
use App\Models\Business;

class OnlinePaymentController extends Controller
{
    public function index($business_slug)
    {
        $business = Business::where('slug', $business_slug)->published()->active()->first();

        abort_if(! $business, 404);
        abort_if(! $business->paybizWallet, 404);
        abort_if(! $business->paybizWallet->active, 404);

        $this->data['business'] = $business;
        $this->data['paymentCategories']   = PaymentCategory::with(['paymentMethods' => function ($query) {
            $query->active();
            // $query->active()->select('id', 'payment_category_id', 'active');
        }])->whereRelation('paymentMethods', 'active', 1)->active()->get();

        return view('v2.pages.online_payment', $this->data);
        // return view('v2.pages.online_payment_vue', $this->data);
    }

    /** 
     * GET PAYMENT METHOD
     */
    public function getPaymentMethod($id)
    {
        $paymentMethod = PaymentMethod::active()->findOrFail($id);
        return $paymentMethod;
    }

    /** 
     * SUBMIT PAYMENT
     */
    public function submitPayment(Request $request, $business_slug)
    {
        // Validate Input Data
        $validator  =   Validator::make($request->all(), [
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
        // Error Inputs
        if ($validator->fails()) {
            return redirect(url()->previous())
                ->withErrors($validator)
                ->withInput();
        }
        
        // Check If Business is Exist and Paybiz Wallet
        $business = Business::where('slug', $business_slug)->first();
        abort_if(! $business, 404);
        abort_if(! $business->paybizWallet, 404);
        abort_if(! $business->paybizWallet->active, 404);
        // dd((double)$business->paybizWallet->minimum_amount, (double)$request->amount, (double)$business->paybizWallet->minimum_amount > (double)$request->amount);
        if((double)$business->paybizWallet->minimum_amount > (double)$request->amount) {
            $validator->errors()->add('amount', 'Invalid Amount');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        // dd('123');
        // Get Payment Method
        $paymentMethod = PaymentMethod::where('id', $request->payment_method_id)->active()->first();

        // Validate Payment Method Category
        if(! $paymentMethod->paymentCategory) {
            $validator->errors()->add('payment_method_id"', 'Invalid Payment Method');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(! $paymentMethod->paymentCategory->active) {
            $validator->errors()->add('payment_method_id"', 'Invalid Payment Method');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        /** 
         * INITIALIZE THE PAYNAMICS DATA
         */
        $paynamics      = new PaynamicsController();
        $payment_data   = $paynamics->initialize($business, $paymentMethod, $request->input());

        // Error Initialization
        if($payment_data['status'] != 'success') {
            if(! $payment_data['message'] ) {
                \Alert::error('<h4>Payment Error</h4>Something went wrong, please reload the page.')->flash();
                abort(400, $payment_data['message']);
                return redirect()->back();
            }
            \Alert::warning($payment_data['message'])->flash();
            return redirect(url()->previous());
        }

        /** 
         * CREATE PAYNAMICS PAYMENT
         */
        $createPayment = $paynamics->createPayment($payment_data['data']);

        // Error Paynamics Payment Creation
        if($createPayment['status'] != 'success') {
            if(! $createPayment['message'] ) {
                \Alert::error('<h4>Payment Error</h4>Something went wrong, please reload the page.')->flash();
                abort(400);
                return redirect()->back();
            }
            \Alert::warning($createPayment['message'])->flash();
            abort(400, $createPayment['message']);
            return redirect()->back();
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
                return Redirect::route('online_payment.instructions', ['request_id' => $decoded_data->request_id]);
            }
            \Alert::success('Payment has been processed')->flash();
            return redirect()->to($decoded_data->direct_otc_info);
        }

        if(isset($decoded_data->payment_action_info)) {
            if(is_array($decoded_data->payment_action_info)) {
                $payment_instructions = $decoded_data->payment_action_info[0];

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

                return Redirect::route('online_payment.instructions', ['request_id' => $decoded_data->request_id]);
            }
        }

        \Alert::success('Payment has been processed')->flash();
        return redirect()->to($decoded_data->direct_otc_info ?? $decoded_data->payment_action_info);
    }

    public function showInstructions($request_id)
    {
        $paynamicsPayment = PaynamicsPayment::where('request_id', $request_id)
                                ->where('response_code', 'GR033')
                                ->first();

        if(! $paynamicsPayment) {
            abort(404);
        }

        if(Carbon::parse($paynamicsPayment->expiry_limit)->format('F d, Y h:i A') < Carbon::now()->format('F d, Y h:i A')) {
            abort(404);
        }

        $data = [
            'business'       => $paynamicsPayment->paymentable,
            'paymentMethod'  => $paynamicsPayment->paymentMethod,
            'amount'         => (double)$paynamicsPayment->amount + (double)$paynamicsPayment->fee,
            'paynamicsPayment'      => $paynamicsPayment
        ];

        $paynamicsPayment = json_decode($paynamicsPayment);

        /** 
         * PAYMENT INSTRUCTION // Check If Direct OTC Info is Array
         */
        if(isset($paynamicsPayment->direct_otc_info)) {
            if(is_array(json_decode($paynamicsPayment->direct_otc_info))) {
                $payment_instructions = json_decode($paynamicsPayment->direct_otc_info)[0];

                $data['payment_instructions'] = $payment_instructions;
                return view('v2.onlinePayments.payment_instructions')->with($data);
            }
        }

        if(isset($paynamicsPayment->payment_action_info)) {
            if(is_array(json_decode($paynamicsPayment->payment_action_info))) {
                $payment_instructions = json_decode($paynamicsPayment->payment_action_info)[0];

                $data['payment_instructions'] = $payment_instructions;
                return view('v2.onlinePayments.payment_instructions')->with($data);
            }
        }

        \Alert::success('Payment has been processed')->flash();
        return redirect()->to($paynamicsPayment->direct_otc_info ?? $paynamicsPayment->payment_action_info);
    }
}