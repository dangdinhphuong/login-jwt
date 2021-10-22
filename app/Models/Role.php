<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function permissions(){
        return $this->belongsToMany(Permissions::class, 'permissions_roles','role_id', 'permission_id');
    }
    public function roles_users(){
        return $this->belongsToMany(User::class, 'roles_users','role_id', 'user_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_users', 'user_id', 'role_id');
    }
    public function Permissions_roles(){
        return $this->hasMany(Permissions_roles::class,'role_id',);
    }
}
