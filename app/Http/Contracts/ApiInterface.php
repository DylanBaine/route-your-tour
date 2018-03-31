<?php namespace App\Http\Contracts;

interface ApiInterface {

	public function allProfiles();

	public function profileBySlug($slug);

}