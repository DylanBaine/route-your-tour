# Planning of Route Your Tour features

## The model rules and database structure

* User
	* email
	* email_confimred_token
	* name
	* password
	* number_of_active_profiles 
	* Can have many Band and Venue models.
	* Can have one Promoter or BookingAgent profile

* Route
	* title
	* band_id
	* bookingagent_id
	* Can belong to Band or Promoter
	* Has many Locations

* Location
	* address
	* venue_id
		* If address matches a Venues address this has that Venue
	* venue_name
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


## Eloquent Structure I want

* Example Using The Users Band
	* Auth::user()->bands outputs the users bands

# Tests To Run

* Assign Bands, Venues, Promoters, and BookingAgents to a User

* Create a Route for a Users Band

* Add Locations to that Users Route

