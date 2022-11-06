<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function users(){
        return $this->belongsToMany('App\Models\User', 'exercise_user', 'exercise_id', 'user_id');
    }
    public function submitExercises(){
        return $this->hasMany('App\Models\SubmitExercise', 'exercise_id', 'id');
    }
}
