<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('name', 'like', '%' . request()->search . '%');
    }
    
    public function user(){
        return $this->belongsTo('App\User', 'id_manager');
    }
    
    public function tasks(){
        return $this->hasMany('App\Tasks');
    }
}
