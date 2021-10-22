<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permissions;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private $permissions;
    private $role;
    public function __construct(Permissions $permissions, Role $role)
    {
        $this->permissions = $permissions;
        $this->role = $role;
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {     
        $data = $this->role->all();
        return response()->json([
            'status' => true,
            'code'=>200,
            'data' => $data], 200);
    }

    public function create()
    {  
        $permissions_parent = $this->permissions->where('parent_id', 0)->get();
        $data=[];
        foreach($permissions_parent as $permissions_parents){
            $action=[];
           
            foreach($permissions_parents->permissionsChilden as $permissionsChildenItem){
               $action[]=[
                            'id'=>$permissionsChildenItem->id,
                            'name'=>$permissionsChildenItem->name,
                        ];
            }
            $data[]=[
                'module_name'=>$permissions_parents->name,
                'desc'=>$permissions_parents->desc,
                'action'=>$action 
            ];
        }
        return response()->json([
            'status' => true,
            'code'=>200,
            'data' => $data], 200);
    }

    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|max:100|min:4',
            'role_desc' => 'required|max:200|min:4',
            'permission_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([            
                'status' => false,
                'code'=>422,
                'message' =>$validator->errors()
                ], 422);
        }

        try {
            DB::beginTransaction();
            $roles =  $this->role->create([
                'name' => $request->role_name,
                'desc' => $request->role_desc
            ]);

            $roles->permissions()->attach($request->permission_id);
            DB::commit();
            return response()->json([            
                'status' => true,
                'code'=>200,
                'message' =>'Thêm mới chức vụ thành công !',
                ], 200);
        
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([            
                'status' => false,
                'code'=>400,
                'message' =>"that bai"
                ], 400);
        }
    }

    public function edit(Request $request)
    {
        
        $permissions_parent = $this->permissions->where('parent_id', 0)->get();
        $roles = $this->role->find($request->id);

        $permissions=[];
        foreach($permissions_parent as $permissions_parents){
            $action=[];
            foreach($permissions_parents->permissionsChilden as $permissionsChildenItem){
               $action[]=[
                            'id'=>$permissionsChildenItem->id,
                            'name'=>$permissionsChildenItem->name,
                        ];
            }
            $permissions[]=[
                'module_name'=>$permissions_parents->name,
                'desc'=>$permissions_parents->desc,
                'action'=>$action 
            ];
        }


        if (isset($roles) && !empty($roles)) {
            $permissionsChecked = $roles->permissions;
            $permissionsCheckeds=[];
            foreach($permissionsChecked as $permissionsCheckedItem){
               $permissionsCheckeds[]=[
                            'id'=>$permissionsCheckedItem->id,
                        ];
            }
            return response()->json([
                'status' => true,
                'code'=>200,
                'data' => [
                    'permissions'=>$permissions,
                    'permission_Checked'=>$permissionsCheckeds,
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
            'role_name' => 'required|max:100|min:4',
            'role_desc' => 'required|max:200|min:4',
            'permission_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([            
                'status' => false,
                'code'=>422,
                'message' =>$validator->errors()
                ], 422);
        }
        try {
            DB::beginTransaction();
            $this->role->find($_GET['id'])->update([
                'name' => $request->role_name,
                'desc' => $request->role_desc
            ]);
            $roles = $this->role->find($_GET['id']);
            $roles->permissions()->sync($request->permission_id); // upload update array to role_user ===> 'sync'
            DB::commit();
           
            return response()->json([            
                'status' => true,
                'code'=>200,
                'message' =>'Cập nhật chức vụ thành công !',
                ], 200);

        } catch (Exception $exception) {
            DB::rollBack();
           // 
           return response()->json([            
            'status' => false,
            'code'=>400,
            'message' =>"Cập nhật chức vụ thất bại",
            ], 400);
        }
    }

    public function destroy(Request $request)
    {
        $roles = $this->role->find($request->id);
        if (isset($roles) && !empty($roles)) {
        
            if($roles->status===1){
                return response()->json([
                    'status' => false,
                    'code'=>407,
                    'message' => "Proxy Authentication Required"
                ], 407);
            }

            $roles->delete();

            return response()->json([
                'status' => true,
                'code'=>200,
                'data' => "xóa role thanh công"
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

// [
//     2,
//     3,
//     4,
//     5,
//     7,
//     8,
//     9,
//     10,
//     12,
//     13,
//     14,
//     15,
//     17,
//     18,
//     19,
//     20,
//     22,
//     23,
//     24,
//     25,
//     27,
//     28,
//     29,
//     30,
//     32,
// ]