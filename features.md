# Planning of Route Your Tour features

## The model rules and database structure

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
	* name
	* route_id
		* Must belong to a Route	

* Band
	* slug
	* name
	* soundcloud_url
	* bio
	* number_of_routes_booked
	* Can have many Routes
	* Can belong to many Users
	* Can have many SocialLinks

* Venue
	* slug
	* name
	* address
	* Can belong to many Users
	* Can have many SocialLinks

* Promoter
	* user_id
		* Must belong to only one User
	* slug
	* experience
	* Can have many SocialLinks

* BookingAgent
	* user_id
		* Must belong to only one User
	* slug
	* experience
	* Can have many Routes
	* Can have many SocialLinks

* SocialLinks
	* link
	* name
	* icon
	* Can belong to Band, Venue, Promoter, and BookingAgent.

## Pivot Tables

* user_band
	* user_id
	* band_id
	
* user_venue
	* user_id
	* venue_id

* band_route
	* band_id
	* route_id

* route_location
	* route_id
	* location_id

* band_social
	* band_id
	* social_link_id

* venue_social
	* venue_id
	* social_link_id

* promoter_social
	* promoter_id
	* social_link_id

* bookingagent_socal
	* booking_agent_id
	* social_link_id


## Eloquent Structure I want

* Example Using The Users Band
	* Auth::user()->bands()->where('id', $id)->first()  outputs the users band info
	* Auth::user()->bands()->where('id', $id)->routesAss()->where('id', $routeId)->first() outputs specific route the users band has routed

# Tests To Run

* Assign Bands, Venues, Promoters, and BookingAgents to a User

* Create a Route for a Users Band

* Add Locations to that Users Route

