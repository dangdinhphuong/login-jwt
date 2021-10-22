<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function permissionsChilden(){
        return $this->hasMany(Permissions::class, "parent_id");
    }
}
