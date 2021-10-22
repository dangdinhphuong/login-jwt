<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
// use Exception;
class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
public $name="";

    public function deny($message,$code){
     throw new \Exception($message,$code);
    }
    
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("Category-list", function (User $user) {
            $role=$user->roles;
            $permissions = $role->permissions;
            // dd($role->permissions);
            //dd($permissions->contains('key_code',"Category-list"));

            if ($permissions->contains('key_code',"Category-list")) {
                return true;
            }
            $this->deny();
    
               return false;
        });





        // Gate::define("Category_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"Category_add")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });

        // Gate::define("Category_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"Category_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("Category_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"Category_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("products_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"products_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("products_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"products_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("products_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"products_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("products_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"products_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("blog_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"blog_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("blog_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"blog_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("blog_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"blog_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("blog_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"blog_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("role_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"role_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("role_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"role_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("role_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"role_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("role_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"role_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("order_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"order_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("order_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"order_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("order_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"order_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("order_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"order_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("branch_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"branch_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("branch_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"branch_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("branch_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"branch_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("branch_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"branch_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("permission_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"permission_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("permission_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"permission_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("permission_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"permission_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("permission_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"permission_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("user_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"user_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("user_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"user_add")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("user_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"user_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("user_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"user_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });
        // Gate::define("slider_list", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"slider_list")) {
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("slider_add", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"slider_add")) {
        //             return true;
        //         }
        //     }
        //     return false;
        // });

        // Gate::define("slider_edit", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"slider_edit")) {
                    
        //             return true;
        //         }
        //     }

        //     return false;
        // });
        // Gate::define("slider_delete", function (User $user) {
        //     foreach ($user->roles as $role) {
        //         $permissions = $role->permissions;
        //         if ($permissions->contains('key_code',"slider_delete")) {
                    
        //             return true;
        //         }
        //     }
        //     return false;
        // });


  

    //    foreach(config('permissions.permission_childen') as $permission_childen){
    //     foreach(config('permissions.permission_parent') as $permission_parent){
    //         $this->name=$permission_parent.'_'.$permission_childen;
    //         Gate::define("$this->name", function (User $user) {
    //             foreach ($user->roles as $role) {
    //                 $permissions = $role->permissions;
    //                 if ($permissions->contains('key_code',"$this->name")) {
                        
    //                     return true;
    //                 }
    //             }
    //             return false;
    //         });
    //     }
    //    }
        
    }
}