<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany(User::class,'user_role','user_id','role_id');
    }
}
