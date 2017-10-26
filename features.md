# Planning of Route Your Tour features

## The model rules and structure

* User
	* name
	* password
	* number_of_active_profiles 
	* Can have many Band and Venue models.
	* Can have one Promoter or BookingAgent profile

* Route
	* band_id		
		* Must belong to a Band
	* promoter_id
	* Has many Locations

* Location
	* address
	* venue_id
		* If address matches a Venues address this has that Venue
	* route_id
		* Must belong to a Route	

* Band
	* slug
	* name
	* soundcloud_url
	* number_of_routes_booked
	* Can have many Routes
	* Can belong to many Users

* Venue
	* slug
	* name
	* address
	* Can belong to many Users

* Promoter
	* user_id
		* Must belong to only one User
	* slug
	* experience

* BookingAgent
	* user_id
		* Must belong to only one User
	* slug
	* experience
	* Can have many Routes

## Eloquent Structure I want

* Example Using The Users Band
	* Auth::user()->bands()->where('id', $id)->first()  outputs the users band info
	* Auth::user()->bands()->where('id', $id)->routesAss()->where('id', $routeId)->first() outputs specific route the users band has routed

# Tests To Run

* Assign Bands, Venues, Promoters, and BookingAgents to a User

* Create a Route for a Users Band

* Add Locations to that Users Route

