@extends('layouts.guest')

@section('content')
<v-container>
	<header class="padded">
		<h1>{{$band->name}}</h1> 
		<h2>{{$route->title}}</h2>
	</header>
	<section class="padded">
		<ul style="list-style: none; margin: 0; padding: 0;">
			@foreach($route->locations()->where('confirmed', 1)->get() as $location)
				<li>
					<v-layout row wrap style="height: 100%; align-items: center;">
						<v-flex md5>
							<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBmUmk8fp4yEZW6tVkLBJJpBrCMwrk1tag&q={{$location->address}}" 
							frameborder="0"
							width="100%"
							height="90%">				
							</iframe>
						</v-flex>
						<v-flex md4 offset-md1>
							<h4>
								{{$location->venue}}
							</h4>
							<p>
								{{$location->address}}
							</p>
						</v-flex>
						<v-flex>
							<v-btn target="_blank" primary flat fab href="/venues/{{$location->slug}}"><v-icon>link</v-icon></v-btn>
						</v-flex>
					<v-layout>
				</li>
			@endforeach
		</ul>
	</section>
</v-container>
@stop