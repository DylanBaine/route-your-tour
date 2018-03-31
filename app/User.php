<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password', 'number_of_active_profiles', 'email_confirmed_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function canAddProfile(){

        $user = Auth::user();

        if($user->premium_level > 1){

            return true;

        }else if($user->premium_level < 2 && $user->bands->count() != 1 ){

            return true;

        }else{

            return false;
            
        }

    }

    public function bands()
    {
        return $this->belongsToMany(Band::class);
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }

    public function promoter()
    {
        return $this->hasOne(Promoter::class);
    }

    public function bookingagent()
    {
        return $this->hasOne(BookingAgent::class);
    }
}
