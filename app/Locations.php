<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $fillable = ['venue', 'address', 'venue_id', 'route_id', 'band_id'];

    public function route()
    {
    	return $this->belongsTo(Routes::class);
    }

    public function venue()
    {
    	return $this->belongsTo(Venue::class);
    }

    public function band()
    {
    	return $this->belongsTo(Band::class);
    }
}
