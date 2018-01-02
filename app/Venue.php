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
            $venue->routes()->delete();
            $venue->locations()->delete();
            DB::table('venue_user')->where('venue_id', $venue->id)->delete();
            File::delete('storage/' . $venue->banner);
            File::delete('storage/' . $venue->profile_image);
        });
    }
}
