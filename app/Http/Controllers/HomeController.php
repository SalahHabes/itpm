<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function assign()
    {

        $users = User::search()->where('id', '!=', auth()->id())->orderBy('name')->paginate(10);

        //$results = json_decode($users, true);
        return view('admin.assign', [
            'users' => $users,
        ]);
    }

    public function changeAssign(Request $request)
    {
        $user = User::where('email', $request['email'])->firstOrFail();
        $user->roles()->detach();
        if ($request['role'] == '1') {
            $user->roles()->attach(Role::where('name', 'Employee')->first());
        }
        if ($request['role'] == '2') {
            $user->roles()->attach(Role::where('name', 'Manager')->first());
        }
        if ($request['role'] == '3') {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        return redirect('/assign')->with('assignedSuccessfully', 'Roles Changed Successfully');
    }

    public function signup()
    {
        return view('admin.signup');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'max:30'],
            'phone' => ['max:15'],
            'birth' => ['required'],
            'password' => ['required', 'min:3', 'max:255'],
        ]);

        $userExists = DB::table('users')->where('email', $request['email'])->first();
        $todayDate = date("Y-m-d");

        if($request['gender'] == null){
            $request['gender'] = "other";
        }

        if ((!$userExists) && ($request['birth'] < $todayDate)) {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->phone = $request['phone'];
            $user->gender = $request['gender'];
            $user->birth = $request['birth'];
            $user->password = bcrypt($request['password']);
            $user->save();
            if ($request['role'] == '1') {
                $user->roles()->attach(Role::where('name', 'Employee')->first());
            }
            if ($request['role'] == '2') {
                $user->roles()->attach(Role::where('name', 'Manager')->first());
            }
            if ($request['role'] == '3') {
                $user->roles()->attach(Role::where('name', 'Admin')->first());
            }
            return redirect('/signup')->with('SignedUpSuccess', 'User Signed up Successfully');
        } else {
            if ($request['birth'] >= $todayDate) {
                return redirect('/signup')->with('BdFail', 'Birth Date invalid');
            } else {
                return redirect('/signup')->with('SignedUpFail', 'Can\'t Sign up User with Already Existing Email');
            }
        }
    }
}
