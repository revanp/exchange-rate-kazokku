<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        if (Auth::user()->role->name != 'Admin'){
            abort(404);
        }

        $users = User::with([
                'role'
            ])
            ->whereHas('role', function($query){
                $query->where('name', 'Staff');
            })
            ->get();

        return view('pages.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        unset($input['_token']);

        $rules = [
            'name'     => ['required'],
            'username' => ['required'],
            'password' => ['required'],
        ];

        $messages = [];

        $attributes = [
            'name'     => 'Name',
            'username' => 'Username',
            'password' => 'Password',
        ];

        $validator = Validator::make($input, $rules, $messages, $attributes);

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

        $isError = false;

        try {
            DB::beginTransaction();

            $getAdminRole = Role::where('name', 'Staff')->first();

            $user = new User();

            $user->fill([
                'role_id' => $getAdminRole->id,
                'name' => $input['name'],
                'username' => $input['username'],
                'password' => bcrypt($input['password']),
            ])->save();

            $message = 'User created successfully';

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            $isError = true;

            $err     = $e->errorInfo;

            $message =  $err[2];
        }

        if ($isError == true) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $message
            ], 500)
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ]);
        }else{
            session()->flash('success', $message);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => $message,
                'redirect' => url('users')
            ], 200)->withHeaders([
                'Content-Type' => 'application/json'
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => $user
        ])->withHeaders([
            'Content-Type' => 'application/json'
        ]);
    }

    public function update($id, Request $request)
    {
        $input = $request->all();

        unset($input['_token']);

        $rules = [
            'name'     => ['required'],
            'username' => ['required'],
            'password' => [],
        ];

        $messages = [];

        $attributes = [
            'name'     => 'Name',
            'username' => 'Username',
            'password' => 'Password',
        ];

        $validator = Validator::make($input, $rules, $messages, $attributes);

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

        $isError = false;

        try {
            DB::beginTransaction();

            $getAdminRole = Role::where('name', 'Staff')->first();

            $user = User::find($id);

            $data = [
                'role_id' => $getAdminRole->id,
                'name' => $input['name'],
                'username' => $input['username'],
            ];

            if(!empty($input['password'])){
                $data['password'] = bcrypt($input['password']);
            }

            $user->fill($data)->save();

            $message = 'User updated successfully';

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();

            $isError = true;

            $err     = $e->errorInfo;

            $message =  $err[2];
        }

        if ($isError == true) {
            return response()->json([
                'code' => 500,
                'success' => false,
                'message' => $message
            ], 500)
                ->withHeaders([
                    'Content-Type' => 'application/json'
                ]);
        }else{
            session()->flash('success', $message);

            return response()->json([
                'code' => 200,
                'success' => true,
                'message' => $message,
                'redirect' => url('users')
            ], 200)->withHeaders([
                'Content-Type' => 'application/json'
            ]);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('users')
            ->with(['success' => 'User deleted successfully']);
    }
}
