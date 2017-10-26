# Planning of Route Your Tour features

## The model rules and structure

* User
	* Name
	* Password
	* Number of active profiles 
	* Can have many Band, Venue, BookingAgent, or Promoter profiles

* Route
	* band_id
	* promoter_id
	* Have to belong to a Profile
	* Has many Locations

* Location
	* venue_id
	* Address
	* If address matces a profile this has that profile
	* Has to belong to a Route

* Band
	* user_id
	* slug
	* Can have many Routes

* Venue
	* user_id
	* slug
	* address

* Promoter
	* user_id
	* slug
	* experience

* BookingAgent
	* user_id
	* slug
	* experience
	* Can have many Routes

## Eloquent Structure I want

* Example Using The Users Band
	* Auth::user()->band->where('id', $id)->first()  outputs the users band info
	* Auth::user()->band->where('id', $id)->route->where('id', $routeId)->first() outputs specific route the users band has routed