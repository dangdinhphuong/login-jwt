<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissions;

class permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('permissions.permission_parent') as $module){
            $permission = Permissions::create([
                'name' => $module[0],
                'desc' => $module[1],
                'parent_id' => 0,
                'key_code' => ''
            ]);

            foreach (config('permissions.permission_childen') as $value_module) {
    
                Permissions::create([
                    'name' => $value_module,
                    'desc' => "",
                    'parent_id' => $permission->id,
                    'key_code' => $module[0] . '-' . $value_module,
    
                ]);
            }
            
        };
    }
}
