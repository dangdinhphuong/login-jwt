<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            // dd($validator->errors()->toJson());
          return response()->json([            
          'status' => false,
          'code'=>400,
          'message' =>$validator->errors()
          ], 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'status' => true,
            'code'=>200,
            'message' => 'User successfully registered',
        ], 200);
    }   
    
    public function changePassWord(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userId = auth()->user()->id;

        $user = User::where('id',$userId)->update(
                    ['password' => bcrypt($request->new_password)]
                );

        return response()->json([
            'message' => 'User successfully changed password',
            'user' => $user
        ], 201);
    }       

    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([            
                'status' => false,
                'code'=>422,
                'message' =>$validator->errors()
                ], 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            
            return response()->json([
                'status' => false,
                'code'=>401,
                'error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token,'User successfully login');
    }

    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    public function userProfile() {
        return response()->json([            
            'status' => false,
            'code'=>200,
            'users' =>auth()->user()
            ]);
          
    }

    protected function createNewToken($token,$message=""){
        return response()->json([
            'status' => true,
            'code'=>200,
            'message' => $message,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60*60,
            'user' => auth()->user()
        ]);
    }
}
