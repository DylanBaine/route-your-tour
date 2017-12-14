@extends('layouts.guest')

@section('content')
<header>

	<v-layout row wrap class="padded">

		<v-flex md6 class="padded">

			<header>
				<h5>Search by Name, City, Country, Etc...</h5>
			</header>

			<form action="/venues/search">
				
				<v-text-field
					name="param"
					placeholder="Tulsa, OK"
				></v-text-field>

				<v-btn color="primary" href="/venues/category/auditorium/">
					Search
				</v-btn>

			</form>

		</v-flex>		
		
		<v-flex md6 class="padded text-xs-right">

			<header>
				<h5>Search Category</h5>
			</header>

			<v-btn color="primary" href="/venues">
				All
			</v-btn>

			<v-btn color="primary" href="/venues/category/bar-venue">
				Bar
			</v-btn>

			<v-btn color="primary" href="/venues/category/auditorium">
				Auditorium
			</v-btn>

			<v-btn color="primary" href="/venues/category/arena">
				Arena
			</v-btn>

			<v-btn color="primary" href="/venues/category/festival">
				Festival
			</v-btn>

			<v-btn color="primary" href="/venues/category/stadium">
				Stadium
			</v-btn>

			<v-btn color="primary" href="/venues/category/amphitheatre">
				Amphitheatre
			</v-btn>

			<v-btn color="primary" href="/venues/category/restaurant">
				Restaurant
			</v-btn>			

			<v-btn color="primary" href="/venues/category/club">
				Club
			</v-btn>

			<v-btn color="primary" href="/venues/category/event-venue">
				Event Venue
			</v-btn>

		</v-flex>

	</v-layout>

</header>

<v-container fluid grid-list-xl>

	@if(Auth::user())
	<v-dialog v-model="dialog">

		<v-card>

			<v-card-title class="headline text-xs-center">Add "@{{dialogTarget.venue}}" to a tour.</v-card-title>

			<v-card-text>

				<v-select
					v-bind:items="bands"
					v-model="pickedBand"
					label="Choose a band."
					single-line
					item-text="name"
					item-value="slug"
					bottom
					@change="reset"
				>
				</v-select>	
				<v-select
					v-if="nextStep && !noVenues"
					v-bind:items="routes"
					v-model="pickedTour"
					label="Choose a tour."
					single-line
					item-text="title"
					item-value="id"
					bottom	
				>
				</v-select>

			</v-card-text>

			<v-card-actions>

				<v-spacer></v-spacer>

				<v-btn v-if="nextStep && !noVenues" large color="blue darken-1" class="white--text" @click="addLocation">Add to tour.</v-btn>

				<v-btn v-if="!nextStep" large color="blue darken-1" class="white--text" @click="pickTour">Choose a tour.</v-btn>

				<v-btn v-if="noVenues && nextStep" large color="blue darken-1" :href=" '/home#/band/' + pickedBand + '/tour' " class="white--text"><small>Add first route.</small></v-btn>

				<v-btn flat large color="red darken-1" @click.native="dialog = false">Cancel</v-btn>

				<v-spacer></v-spacer>

			</v-card-actions>

		</v-card>

	</v-dialog>
	@endif


	<v-layout row wrap>
		@foreach($venues as $venue)
		<v-flex md4 xs12>
			<v-card  color="blue" class="card text-xs-center flexed white--text padded" data-ripple='true' style="height: 300px; display: flex; align-items: center; justify-content: center; position: relative; overflow: auto;">
				<div>

					<h4>{{$venue->name}}</h4>
					<br>
					<h5>{{$venue->address}}</h5>
					<hr>
					<h6>{{$venue->category}}</h6>

				</div>

				<div class="text-xs-right absolute bottom-right">
					<v-btn fab raised class="blue darken-4 white--text" href="/venues/{{$venue->slug}}" title="Visit {{$venue->name}}'s RYT profile.">
						Visit
					</v-btn>
					@if(Auth::user())
						<v-btn @click='addThisToTour("{{$venue->address}}", "{{$venue->name}}")' fab class="blue darken-3 white--text" title="Add {{$venue->name}} to a tour.">
							<v-icon>add</v-icon>
						</v-btn>
					@endif
				</div>

			</v-card>
		</v-flex>		
		@endforeach
	</v-layout>

	<div class="text-xs-center">
		{{$venues->links()}}
	</div>

</v-container>
@stop