<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use Notifiable;

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('email', 'like', '%' . request()->search . '%');
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'user_role','user_id','role_id');
    }

    public function hasAnyRoles($roles){
        if(is_array($roles)) {
            foreach ($roles as $role) {
                if($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name',$role)->first()) {
            return true;
        }
        return false;
    }

    public function isManager() {
        return $this->roles()->where('name', 'Manager')->exists();
    }

    public function isEmployee() {
        return $this->roles()->where('name', 'Employee')->exists();
    }

    public function isAdmin() {
        return $this->roles()->where('name', 'Admin')->exists();
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function tasks(){
        return $this->belongsToMany('App\Task', 'associationtask', 'id_employee', 'id_task');
    }

    public function employees(){
        return $this->belongsToMany('App\User', 'associationuser', 'id_manager', 'id_employee');
    }

    public function managers(){
        return $this->belongsToMany('App\User', 'associationuser', 'id_employee', 'id_manager');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function Added($id){
        return $this->myEmployees($this->id)->where('id', '=', $id)->exists();
    }

    public static function myEmployees($id){
        
        $employees_id = DB::table('associationuser')
            ->select('id_employee')
            ->where('id_manager', '=', $id);

        $employees = User::joinSub($employees_id, 'employees', function($join) {
                $join->on('users.id', '=', 'employees.id_employee');
            });
        return $employees;
    }
}
