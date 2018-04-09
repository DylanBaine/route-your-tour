<?php

namespace App\Http\Controllers\Users;

use App\Http\Repositories\UserProfilesRepository;
use Auth;

class ProfilesController {
	private $repo;
	public function __construct()
	{
		$this->repo = new UserProfilesRepository;
	}
	public function __invoke($table = null, $slug = null){
		if($slug != null){
			return $this->show($table, $slug);
		}
		if($table != null){
			return $this->index($table);
		}
		return $this->repo->allProfileTypes();
		
	}
	public function index($table){
		return $this->repo->allProfiles($table);
	}
	public function show($table, $slug){
		return $profile = $this->repo->profileBySlug($table, $slug);
	}
}