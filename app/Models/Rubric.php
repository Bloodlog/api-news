<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $fillable = ['name'];
    //
    /*public function roles()
    {
        return $this->belongsToMany('Subscribe', 'subscriptions', 'subscribe_id', 'rubric_id');
    }*/
    public function subscribes()
    {
        return $this->belongsToMany('App\Models\Subscription', 'subscriptions', 'subscribe_id', 'rubric_id')->withTimestamps();
    }
}
