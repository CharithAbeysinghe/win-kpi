<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'sADmin', 
            'email' => 'sadmin@gmail.com',
            'password' => '$2y$10$XRZmMHYWuM0KsWFEuXg8Y.n9mbMdz8RU01TZ4bc9tELY3lyuapni2',
            'u_tp_id' => 1,
            'location_id'=>0,
            'department_id'=>0,
        ]);
    
        $role = Role::create(['name' => 'sadmin']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
