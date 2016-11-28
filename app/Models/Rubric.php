<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubric extends Model
{
    protected $fillable = ['name'];

    public function subscribes()
    {
        return $this->belongsToMany('App\Models\Subscribe', 'subscriptions', 'rubric_id', 'subscribe_id' )->withTimestamps();
    }
}
