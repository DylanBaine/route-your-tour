<?php 
namespace 
App\Http\Repositories;

use App\Http\Contracts\ApiInterface;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class UserProfilesRepository implements ApiInterface
{

	/**
	 * Return all of a users profiles from a given table
	 * @param  string $table the profile type that we are returning
	 * @return JSON  		 the collection of profiles that belong the authenticated user
	 */
	public function allProfiles($table){
		$user = Auth::user()->with($table)->first();
		return $user[$table];
	}
	/**
	 * Return a users specific band matching the slug
	 * @param  string $table the table that the profile is in
	 * @param  string $slug  the slug we want to use to return the one profile
	 * @return JSON          the profile in the table that belongs to the user with the given slug 
	 */
	public function profileBySlug($table, $slug){
		$profiles = Auth::user()->with($table)->first()[$table];
		foreach ($profiles as $profile) {
			if($profile->slug == $slug){
				return $profile;
			}
		}
	}

	public function allProfileTypes(){
		return Auth::user()->with('bands', 'venues', 'promoter', 'bookingAgent')->first();
	}

}