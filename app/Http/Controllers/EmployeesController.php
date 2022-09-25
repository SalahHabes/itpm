<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\AssociationUser;
use App\Role;
use App\User_Role;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myemp()
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }
        $employees = User::myEmployees($user->id)->select('id', 'name', 'email', 'phone')->search()->paginate(10);
        return view('employees.myemp', [
            'employees' => $employees
        ]);
    }

    public function global()
    {
        $user = auth()->user();
        if ($user->isEmployee()) {
            return redirect('/');
        }

        $role_id = Role::select('id')->where('name', '=', "employee");
        
        $employeesid = User_Role::joinSub($role_id, 'roleid', function($join) {
            $join->on('user_role.role_id', '=', 'roleid.id');
        })->select('user_id');
        
        $employees = User::joinsub($employeesid, 'employeesid', function($join) {
            $join->on('users.id', '=', 'employeesid.user_id');
        })->select('id', 'name', 'email', 'phone')->search()->paginate(10);
        
        return view('employees.global', [
            'employees' => $employees
        ]);
    }

    public function add($id)
    {
        $user = auth()->user();
        $association = new AssociationUser();
        $association->id_manager = $user->id;
        $association->id_employee = $id;
        $association->save();

        return redirect('/employees/global')->with('addsuccess', 'Employee Added');
    }

    public function remove($id)
    {
        $user = auth()->user();

        $association = DB::table('associationuser')
            ->where('id_manager', '=', $user->id)
            ->where('id_employee', '=', $id)
            ->delete();

        return redirect('/employees')->with('removesuccess', 'Employee Removed');
    }
}
