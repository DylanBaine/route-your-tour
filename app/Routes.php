<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    protected $fillable = ['title', 'band_id', 'booking_agent_id'];

    public function bands()
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
}
