<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function routes()
    {
    	return $this->hasMany(Routes::class);
    }
}
