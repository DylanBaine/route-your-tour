<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\User;
use \App\Band;
use \App\Routes;

class AssignProfileToUserTest extends TestCase
{
	use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddingBandProfileToUser()
    {

    	$user = factory(User::class, 1)->create();

    	$auth = User::first();

    	$auth->bands = factory(Band::class, 3)->create();

    		$this->assertNotNull($auth->bands);
    }

    public function testAddingARoutToUsersBand()
    {
    	$users = factory(User::class, 1)->create();

    	$user = User::first();

    	$user->bands = factory(Band::class, 3)->create();

    	$band = $user->bands->first();

    	$band->routes = factory(Routes::class, 3)->create();

    	$route = $band->routes->first()->title;

    		$this->assertNotNull($user, $band, $route);  	


    }


}
