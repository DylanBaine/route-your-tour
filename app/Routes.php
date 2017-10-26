<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    protected $fillable = ['address'];

    public function bands()
    {
    	return $this->belongsTo(Band::class);
    }
}
