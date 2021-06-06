<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // === Super admin ===
        $superAdmin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('123456'),
            'mobile' => '123456789',
            'country_id' => 1,
        ]);

        $superRole = Role::find(1);
        $permissions = Permission::pluck('id')->all();
        $superRole->syncPermissions($permissions);
        $superAdmin->assignRole([$superRole->id]);

        // === Regular admin ===
        $regularAdmin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'mobile' => '993956789',
            'country_id' => 1,
        ]);
        $adminRole = Role::find(2);
        $permissions = Permission::pluck('id')->all();
        $adminRole->syncPermissions($permissions);
        $regularAdmin->assignRole([$adminRole->id]);
    }
}
