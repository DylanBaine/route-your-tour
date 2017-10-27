<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
	protected $fillable = [
		'slug', 'name', 'address'
	];

    public function sociallinks()
    {
        return $this->hasMany(SocialLinks::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
}
