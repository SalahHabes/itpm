<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'Employee';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'Manager';
        $role_manager->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->save();
    }
}
