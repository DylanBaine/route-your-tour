@extends('layouts.guest')

@section('content')

<v-container grid-lis-md>
	<header class="padded">
		<h1>All Booked Tours</h1>
	</header>

	<v-layout row wrap>
		@foreach($routes as $route)
			<v-flex md4>
				<v-card href="bands/{{$route->band->slug.'/'.$route->slug}}" color="blue" class="card text-xs-center flexed white--text padded" data-ripple='true' style="height: 300px; display: flex; align-items: center; justify-content: center; position: relative; overflow: auto;">

					<div>

						<h4>{{$route->title}}</h4>
						<br>
						<h5>From: {{$route->band->name}}</h5>

					</div>

				</v-card>

			</v-flex>
		@endforeach
	</v-layout>

</v-container>

@stop