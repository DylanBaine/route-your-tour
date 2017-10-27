<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = [
        'name', 'slug', 'bio', 'number_of_routes_booked', 'soundcloud_url'
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function routes()
    {
    	return $this->hasMany(Routes::class);
    }

    public function sociallinks()
    {
        return $this->hasMany(SocialLinks::class);
    }
}
