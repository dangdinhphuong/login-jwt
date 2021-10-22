<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    private $role;
    private $user;
    public function __construct(Role $role,User $user)
    {
        $this->role = $role;
        $this->user = $user;
        $this->middleware('auth:api');
    }

    public function create(){
        $role = $this->role->all();
        $data=[];
        foreach($role as $roles){
            $data[]=[
                "id" => $roles->id,
                "name" =>$roles->name  
            ];
        }
        return response()->json([
            'status' => true,
            'code'=>200,
            'data' => $data], 200);
    }

    public function register(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password'=> 'required|string|confirmed|min:6',
            'role_id'=> 'required|numeric',
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
    public function edit(Request $request){
       
        $users = $this->user->find($request->id);
       
        if (isset($users) && !empty($users)) {
            $role = $this->role->all();
            $role_data=[];
            foreach($role as $roles){
                $role_data[]=[
                    "id" => $roles->id,
                    "name" =>$roles->name  
                ];
            }
            return response()->json([
                'status' => true,
                'code'=>200,
                'data' => [
                    "users"=>[
                        "id"=> $users->id,
                        "name"=> $users->name,
                        "email"=> $users->email,
                        "status"=> $users->status,
                        "created_at"=> $users->created_at,
                        "updated_at"=> $users->updated_at,
                        "role_id"=> $users->role_id,
                    ],
                    'roles'=>$role_data

                ]], 200);
        

        } else {
            return response()->json([
                'status' => false,
                'code'=>400,
                'message' => "Invalid request"
            ], 400);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|email|unique:users,email,'.$_GET['id'],
            'role_id'=> 'required|numeric',
            'password'=> 'nullable|string|min:6',
        ]);
           
        if ($validator->fails()) {
            return response()->json([            
                'status' => false,
                'code'=>422,
                'message' =>$validator->errors()
                ], 422);
        }
        
        $data=$request->only(['name', 'email','role_id','password']);
        $data['password']=bcrypt($request->password);
        if(empty($request->password)){// nếu pass rỗng thì ko update pass
            $data=$request->only(['name', 'email','role_id']);
        }

        $users = $this->user->find($request->id);
        if (isset($users) && !empty($users)) {
            $users->update($data);
            return response()->json([
                'status' => true,
                'code'=>200,
                'message' => 'User successfully update',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'code'=>400,
                'message' => "Invalid request"
            ], 400);
        }
    }

}