<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
class PermissionSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        /* === Create Permission & Roles === */

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
        DB::table('permissions')->delete();

        /* ================ Created Permission =============== */
            
                    /*===== ADMIN PERMISSION=====*/
        //User Management Admin
        Permission::create(['name' => 'user-index', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user-section', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user-create', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user-edit', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user-destroy', 'guard_name' => 'admin']);
        Permission::create(['name' => 'user-proxy', 'guard_name' => 'admin']);

        //Roles Permissions
        Permission::create(['name' => 'role-section', 'guard_name' => 'admin']);
        Permission::create(['name' => 'role-create', 'guard_name' => 'admin']);
        Permission::create(['name' => 'role-index', 'guard_name' => 'admin']);
        Permission::create(['name' => 'role-edit', 'guard_name' => 'admin']);
        
        //ASSIGN PERMISSIONS TO ADMIN
        $role = Role::where('name','admin')->first();
        $role->givePermissionTo(Permission::all());

                      /*===== USERS PERMISSION =====*/
         //User Management Users
         Permission::create(['name' => 'user-index', 'guard_name' => 'web']);
         Permission::create(['name' => 'user-section', 'guard_name' => 'web']);
         Permission::create(['name' => 'user-create', 'guard_name' => 'web']);
         Permission::create(['name' => 'user-edit', 'guard_name' => 'web']);
         Permission::create(['name' => 'user-destroy', 'guard_name' => 'web']);
         Permission::create(['name' => 'user-proxy', 'guard_name' => 'web']);
    }
}
