<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name','Employee')->first();
        $role_manager = Role::where('name','Manager')->first();
        $role_admin = Role::where('name','Admin')->first();

        $employee = new User();
        $employee->name ='Admin';
        $employee->email ='admin@gmail.com';
        $employee->phone ='0561531178';
        $employee->password = bcrypt('admin');
        $employee->birth ='1999-08-08';
        $employee->gender ='male';
        $employee->save();
        $employee->roles()->attach($role_admin);

        /////////////////////////////////////////////////////////////////////////
        $employee = new User();
        $employee->name ='Manager One';
        $employee->email ='m1@gmail.com';
        $employee->phone ='0561531178';
        $employee->password = bcrypt('111');
        $employee->birth ='1999-11-24';
        $employee->gender ='male';
        $employee->save();
        $employee->roles()->attach($role_manager);

        $manager = new User();
        $manager->name ='Manager Two';
        $manager->email ='m2@gmail.com';
        $manager->phone ='0562154487';
        $manager->password = bcrypt('222');
        $manager->birth ='1999-09-09';
        $manager->gender ='male';
        $manager->save();
        $manager->roles()->attach($role_manager);

        ////////////////////////////////////////////////////////////////////////////
        $admin = new User();
        $admin->name ='Employee One';
        $admin->email ='e1@gmail.com';
        $admin->phone ='0656841452';
        $admin->password = bcrypt('111');
        $admin->birth ='1998-1-2';
        $admin->gender ='female';
        $admin->save();
        $admin->roles()->attach($role_employee);

        $admin = new User();
        $admin->name ='Employee Two';
        $admin->email ='e2@gmail.com';
        $admin->phone ='0657851452';
        $admin->password = bcrypt('222');
        $admin->birth ='1998-1-2';
        $admin->gender ='male';
        $admin->save();
        $admin->roles()->attach($role_employee);

        $admin = new User();
        $admin->name ='Employee Three';
        $admin->email ='e3@gmail.com';
        $admin->phone ='0785841452';
        $admin->password = bcrypt('333');
        $admin->birth ='1998-1-2';
        $admin->gender ='female';
        $admin->save();
        $admin->roles()->attach($role_employee);

        $admin = new User();
        $admin->name ='Employee Four';
        $admin->email ='e4@gmail.com';
        $admin->phone ='0656471872';
        $admin->password = bcrypt('444');
        $admin->birth ='1998-1-2';
        $admin->gender ='male';
        $admin->save();
        $admin->roles()->attach($role_employee);

        $admin = new User();
        $admin->name ='Employee Five';
        $admin->email ='e5@gmail.com';
        $admin->phone ='0587414452';
        $admin->password = bcrypt('555');
        $admin->birth ='1998-1-2';
        $admin->gender ='other';
        $admin->save();
        $admin->roles()->attach($role_employee);
    }
}
