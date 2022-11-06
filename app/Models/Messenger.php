<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function userTo()
    {
        return $this->belongsTo('App\Models\User', 'user_to', 'id');
    }
    public function userFrom()
    {
        return $this->belongsTo('App\Models\User', 'user_from', 'id');
    }
    public function messengerOfParent()
    {
        return $this->belongsTo('App\Models\Messenger', 'parent_id', 'id');
    }
    public function messengerHasChildren()
    {
        return $this->hasMany('App\Models\Messenger', 'parent_id', 'id');
    }
}
