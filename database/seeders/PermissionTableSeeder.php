<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\PermissionGroup;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superRole = Role::where([['name', 'Super admin'], ['guard_name','admin']])->first();
        $adminRole = Role::where([['name', 'admin'], ['guard_name','admin']])->first();

        if(!$superRole)
        {
            Role::create(['name' => 'Super admin', 'guard_name' => 'admin']);
        }

        if(!$adminRole)
        {
            Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        }


        $permissionGroups= ['role', 'admin', 'country', 'city', 'area','page', 'setting', 'statistics'];

        foreach($permissionGroups as $group)
        {
            PermissionGroup::updateOrCreate(['name' => $group], ['name' => $group]);
        }

        $superPermissions = ['role-list', 'role-create', 'role-edit', 'role-delete',
                                'admin-list', 'admin-create', 'admin-edit', 'admin-delete',
                                'country-list', 'country-create', 'country-edit', 'country-delete',
                                'city-list', 'city-create', 'city-edit', 'city-delete',
                                'area-list', 'area-create', 'area-edit', 'area-delete',
                                'page-list', 'page-create', 'page-edit', 'page-delete',
                                'setting-edit', 'statistics-list'
        ];

        foreach($superPermissions as $permission)
        {
            $permissionGroupId = PermissionGroup::where('name', explode('-', $permission)[0])->first();
            $permission = Permission::updateOrCreate(['name' => $permission, 'guard_name' => 'admin', 'group_id' => $permissionGroupId->id], ['name' => $permission, 'guard_name' => 'admin', 'group_id' => $permissionGroupId->id]);

            // $exstingPermission = Permission::where('name', $permission)->first();
            // if(!$exstingPermission)
            // {
            //     $permissionGroupId = PermissionGroup::where('name', explode('-', $permission)[0])->first();
            //     $permission = Permission::create(['name' => $permission, 'guard_name' => 'admin', 'group_id' => $permissionGroupId->id]);
            // }
        }

        $dbPermissions = Permission::select('name')->get();
        foreach($dbPermissions as $permission)
        {
            if(!in_array($permission->name, $superPermissions))
            {
                Permission::where('name', $permission->name)->delete();
            }
        }

        $superRole = Role::find(1);
        $permissions = Permission::pluck('id')->all();
        $superRole->syncPermissions($permissions);
    }
}
