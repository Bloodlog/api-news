<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['email'];
    //
    public function rubrics()
    {
        return $this->belongsToMany('App\Models\Rubric', 'subscriptions',  'subscribe_id', 'rubric_id')->withTimestamps();
    }
}
