<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionsRolesController extends Controller
{
   
    public function create()
    {   $permissions_parent = Permission::where('parent_id', 0)->get();
        // return view('admin.pages.permission.create',compact('permissions_parent'));
    }
}
