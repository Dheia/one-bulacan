<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\ClientException;

use Carbon\Carbon;
use File;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | REGISTER USER
    |--------------------------------------------------------------------------
    */
    public function register(Request $request) 
    {
        $fields = $request->validate([
            'name'      => 'required|string',
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'username'  => 'required|string|unique:users,username',
            'mobile'    => 'nullable|digits:11',
            'address'   => 'required',
            'email'     => 'required|string|unique:users,email',
            'password'  => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name'      => $fields['name'],
            'firstname' => $fields['firstname'],
            'lastname'  => $fields['lastname'],
            'username'  => $fields['username'],
            'mobile'    => $fields['mobile'],
            'address'   => $fields['address'],
            'code'      => $code = substr(md5(uniqid(mt_rand(), true)) , 0, 7),
            'email'     => $fields['email'],
            'password'  => Hash::make($fields['password']),
            'is_first_time_login' => '1',
            'is_admin'  => '0'
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER PASSWORD
    |--------------------------------------------------------------------------
    */
    public function updatePassword(Request $request)
    {
        $user   = auth()->user();

        $validator  =   Validator::make($request->all(), [
            'old_password'  => 'required',
            'new_password'  => 'required|min:6|confirmed'
        ]);

        // If Validation Failed
        if ($validator->fails()) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors(),
            ];
            return response($response, 422);
        }


        if (! Hash::check($request->old_password, $user->password)) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['old_password' => 'Invalid old password.']
            ];
            return response($response, 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $user->tokens()->delete();
        $token  = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE USER PROFILE
    |--------------------------------------------------------------------------
    */
    public function updateProfile(Request $request)
    {
        $user   = auth()->user();

        $validator  =   Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'username'  => 'required|string|unique:users,username,' . $user->id . ',id',
            'email'     => 'required|string|unique:users,email,' . $user->id . ',id',
            'mobile'    => 'required|digits:11',
            'address'   => 'required',
            'password'  => 'required'
        ]);

        // If Validation Failed
        if ($validator->fails()) {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => $validator->errors(),
            ];
            return response($response, 422);
        }

        if (! Hash::check($request->password, $user->password))
        {
            $response = [
                'message' => 'The given data was invalid.',
                'errors'  => ['message' => 'Invalid password provided.']
            ];
            return response($response, 422);
        }

        $user->name         = $request->firstname . ' ' . $request->lastname;
        $user->firstname    = $request->firstname;
        $user->lastname     = $request->lastname;
        $user->username     = $request->username;
        $user->mobile       = $request->mobile;
        $user->address      = $request->address;
        $user->email        = $request->email;

        if($user->save()) {
            $response = [
                'status' => 'success',
                'user'  => $user
            ];
            return response($response, 201);
        }

        $response = [
            'status' => 'error',
            'user'  => $user
        ];
        return response($response, 422);
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE USER ACCOUNT
    |--------------------------------------------------------------------------
    */
    public function deleteAccount()
    {
        $user   = auth()->user();

        $user->tokens()->delete();
        $user->delete();
        
        return response([
            'message' => 'User has been deleted successfully.'
        ], 201);
    }

    /*
    |--------------------------------------------------------------------------
    | USER LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        // Authenticate User
        if (! Auth::attempt($fields)) {
            // Authentication failed...
            return response([
                'message' => 'Invalid credentials provided.'
            ], 401);
        }

        // Get Authenticated User
        $user   = auth()->user();
        // Create User Token
        $token  = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /*
    |--------------------------------------------------------------------------
    | USER LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | USER LOGIN USING SOCIAL MEDIA
    |--------------------------------------------------------------------------
    */
    public function loginSocial($provider, Request $request)
    {
        $validated = $this->validateProvider($provider);

        if (!is_null($validated)) {
            return $validated;
        }

        $user       = null;
        $first_name = null;
        $last_name  = null;
        $location   = null;
        $hometown   = null;
        
        try {
            switch($provider){
                case 'facebook':
                    $user = Socialite::driver($provider)
                        ->fields(['name', 'first_name', 'last_name', 'email'])
                        ->userFromToken($request->token);
                    $first_name = $user->offsetGet('first_name');
                    $last_name  = $user->offsetGet('last_name');
                    // $location   = $user->offsetGet('location') ? $user->offsetGet('location')['name']: null;
                    // $hometown   = $user->offsetGet('location') ? $user->offsetGet('hometown')['name']: null;
                    break;
             
                case 'google':
                    $user = Socialite::driver($provider)
                        ->fields(['name', 'given_name', 'family_name', 'email'])
                        ->userFromToken($request->token);
                    $first_name = $user->offsetGet('given_name');
                    $last_name  = $user->offsetGet('family_name');
                    break;
             
                // You can also add more provider option e.g. linkedin, twitter etc.
                default:
                    $user = Socialite::driver($provider)->userFromToken($request->token);
                    $first_name = $user->getName();
                    $last_name  = $user->getName();
            }
        } catch (ClientException $exception) {
            return response()->json(['message' => $exception->getMessage()], 422);
        }

        $code = substr(md5(uniqid(mt_rand(), true)) , 0, 7);

        $address = $location ?? $hometown;

        $userCreated = User::firstOrCreate(
            [
                'email'     => $user->getEmail()
            ],
            [
                'code'      => $code,
                'name'      => $user->getName(),
                'firstname' => $first_name,
                'lastname'  => $last_name,
                'username'  => $user->getEmail(),
                'address'   => $address,
                'is_admin'  => '0',
                'is_first_time_login'   => '1',
                'email_verified_at'     => Carbon::now(),
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider'      => $provider,
                'provider_id'   => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        $disk = 'public_folder'; 

        // dd($user->getAvatar());
        $fileContents = file_get_contents($user->getAvatar());
        $image = \Image::make($fileContents)->encode('jpg', 90);

        // 1. Generate a filename.
        // $filename = md5($value.time()).'.jpg';
        // dd(public_path());
        // File::put(public_path() . '/uploads/profile/'.$provider.'/' . $user->getId() . ".jpg", $fileContents);
        \Storage::disk($disk)->put('users/'.$provider.'/'.$user->getId() . ".jpg", $image->stream());

        $token = $userCreated->createToken('token-name')->plainTextToken;

        $response = [
            'user'  => $userCreated,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['message' => 'Please login using facebook or google'], 422);
        }
    }
}
