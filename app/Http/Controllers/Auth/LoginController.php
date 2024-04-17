<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);

        $rules = [
            'username' => ['required'],
            'password' => ['required'],
        ];

        $messages = [];

        $attributes = [
            'username' => 'Username',
            'password' => 'Password',
        ];

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if($validator->fails()){
            return response()->json([
                'code' => 422,
                'success' => false,
                'message' => 'Validation error!',
                'data' => $validator->errors()
            ], 422)
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ]);
        }

        $remember = !empty($data['remember']) ? true : false;

        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password'],], $remember)) {
            session()->flash('success', 'You have been successfully logged in');

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => 'You have been successfully logged in',
                'redirect' => url('')
            ], 200)->withHeaders([
                'Content-Type' => 'application/json'
            ]);
        }

        return response()->json([
            'code' => 500,
            'success' => false,
            'message' => 'Wrong password, please try again'
        ], 500)->withHeaders([
            'Content-Type' => 'application/json'
        ]);
    }
}
