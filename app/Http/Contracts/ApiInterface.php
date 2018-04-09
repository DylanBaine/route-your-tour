<?php namespace App\Http\Contracts;

interface ApiInterface {

	public function allProfiles($table);

	public function profileBySlug($table, $slug);

	public function allProfileTypes();

}