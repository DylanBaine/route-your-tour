# Planning of Route Your Tour features

## The model rules and structure

* User
	* name
	* password
	* number_of_active_profiles 
	* Can have many Band and Venue profiles.
	* Can have one Promoter or BookingAgent profile

* Route
	* band_id
	* promoter_id
	* Must belong to a Profile
	* Has many Locations

* Location
	* venue_id
	* Address
	* If address matces a profile this has that profile
	* Must belong to a Route

* Band
	* slug
	* name
	* soundcloud_url
	* number_of_routes_booked
	* Can have many Routes

* Venue
	* slug
	* name
	* address

* Promoter
	* slug
	* experience

* BookingAgent
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

