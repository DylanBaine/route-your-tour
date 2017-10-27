<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialLinks extends Model
{
    protected $fillable = [
    	'link', 'name', 'icon', 'band_id', 'venue_id', 'promoter_id', 'booking_agent_id'
    ];

    public function bands()
    {
    	return $this->belongsTo(Band::class);
    }

    public function venue()
    {
    	return $this->belongsTo(Venue::class);
    }


    public function promoter()
    {
    	return $this->belongsTo(Promoter::class);
    }


    public function bookingagent()
    {
    	return $this->belongsTo(BookingAgent::class);
    }

}
