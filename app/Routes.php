<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
	protected $fillable = ['title', 'band_id', 'booking_agent_id'];

	public function band()
	{
		return $this->belongsTo(Band::class);
	}

	public function promoters()
	{
		return $this->belongsTo(Promoter::class);
	}

	public function locations()
	{
		return $this->hasMany(Locations::class);
	}

	protected static function boot() {
		parent::boot();

		static::deleting(function($routes) { 
			// before delete() method call this
			$routes->locations()->delete();
		});
	}
}
