<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= Admin::create([
            'name' => 'mostafa yehia',
            'email' => 'gad993813@gmail.com',
            'status'=>'active',
            'photo'=>'profile.jpg',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::create(['name' =>'admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);
    }
}
