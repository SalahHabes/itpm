<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $touches = ['project'];

    public function scopeSearch($q)
    {
        return empty(request()->search) ? $q : $q->where('name', 'like', '%' . request()->search . '%');
    }

    public function project(){
        return $this->belongsTo('App\Project', 'id_project');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'associationtask', 'id_task', 'id_employee');
    }

    public function depends_on(){
        return $this->belongsToMany('App\Task', 'dependencytask', 'id_dependant', 'id_priority');
    }

    public function depended_on(){
        return $this->belongsToMany('App\Task', 'dependencytask', 'id_priority', 'id_dependant');
    }

    public function todofirst($id){
        return $this->depends_on()->where('id_dependant', '=', $id)->select('id_priority')->get();
    }
}
