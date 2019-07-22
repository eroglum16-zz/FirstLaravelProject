<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $guarded = [];

    public function tasks(){
        return $this->hasMany(Task::class)->orderByDesc('id');
    }

    public function addTask($body){
        $this->tasks()->create(['body'=>$body]);
    }
}
