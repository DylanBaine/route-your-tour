@extends('layouts.guest')

@section('content')
<header>

<!-- 	<v-layout row wrap class="padded">

	<v-flex md3></v-flex>

	<v-flex md6 class="padded text-xs-center">

		<header>
			<h5>Search by Name, City, Country, Etc...</h5>
		</header>
		
		<search-form url="/bookingAgents" searchfor="bookingAgent"></search-form>

	</v-flex>

</v-layout> -->

</header>

<v-container fluid grid-list-xl>
	<v-layout row wrap>
		@foreach($bookingAgents as $bookingAgent)
		<v-flex md4 xs12>
			<v-card  class="card blue text-xs-center flexed white--text padded bg-stripes" data-ripple='true' style="height: 300px; display: flex; align-items: center; justify-content: center; position: relative; overflow: auto;">
				<div>

					<h4>{{$bookingAgent->name}}</h4>

				</div>

				<div class="text-xs-right absolute bottom-right">
					<v-btn fab raised class="blue darken-4 white--text" href="booking-agents/{{$bookingAgent->slug}}" title="Visit {{$bookingAgent->name}}'s RYT profile.">
						Visit
					</v-btn>
				</div>

			</v-card>
		</v-flex>		
		@endforeach
	</v-layout>
</v-container>
<div class="text-xs-center">
	{{$bookingAgents->links()}}
</div>
@stop