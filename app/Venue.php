<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use File;

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

    protected static function boot() {
        parent::boot();

        static::deleting(function($venue) {
            DB::table('user_venue')->where('venue_id', $venue->id)->delete();
            File::delete('storage/' . $venue->banner);
            File::delete('storage/' . $venue->profile_image);
        });
    }
}
