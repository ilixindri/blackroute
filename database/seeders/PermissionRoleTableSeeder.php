<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_';
        });
        //https://codebrisk.com/blog/filtering-eloquent-models-in-laravel-with-eloquent-filter
        //filter return of model laravel
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}