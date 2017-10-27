<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promoter extends Model
{
	protected $fillable = [
		'user_id', 'slug', 'experience',
	];

    public function sociallinks()
    {
        return $this->hasMany(SocialLinks::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
