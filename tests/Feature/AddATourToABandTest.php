<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \App\User;
use \App\Band;
use \App\Routes;
use \App\Locations;

class AddATourToABandTest extends TestCase
{

	use RefreshDatabase;
	use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */

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

    public function testAddingLocationsToABandsTour()
    {
    	$users = factory(User::class, 1)->create();

    	$user = User::first();

    	$user->bands = factory(Band::class, 3)->create();

    	$band = $user->bands->first();

    	$routes = factory(Routes::class, 3)->create();

    	$route = Routes::where('band_id', 1)->first();

    	$route->locations = factory(Locations::class, 1)->create();

    	$location = $route->locations->first()->address;

    		$this->assertNotNull($location);
    }
}
