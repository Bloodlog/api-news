<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $fillable = ['email'];
    //

    public function rubrics()
    {
        return $this->belongsToMany('App\Models\Rubric', 'subscriptions', 'rubric_id', 'subscribe_id')->withTimestamps();
    }
}
