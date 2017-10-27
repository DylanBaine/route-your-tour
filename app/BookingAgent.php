<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingAgent extends Model
{
	protected $fillable = [
		'slug', 'user_id', 'experience'
	];

    public function sociallinks()
    {
        return $this->hasMany(SocialLinks::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function routes()
    {
    	return $this->hasMany(Routes::class);
    }
    

}
