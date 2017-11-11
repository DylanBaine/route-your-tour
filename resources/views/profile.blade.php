@extends('layouts.guest')

@section('content')

<v-container fluid class="venue-page">

	<header id="page-hero" style="background-image: url( {{ url('storage/' . $page->banner_image) }} );">
		<div class="inner text-xs-center">
			<h1>{{$page->name}}</h1>
		</div>
	</header>

	<section id="about">	
		<header class="padded text-xs-center">
			<h3>
				{{$page->address}} <a href="/{{$page->country_slug}}">{{$page->country}}</a>
			</h3>
		</header>
		<v-container class="padded" grid-list-md>

			<article>
				<v-layout row wrap>
					@if($page->amenities != null)
					<v-flex xs12 md4>
						<header>
							<h4>Amenities</h4>
							<hr>
						</header>
						<p>
							{{$page->amenities}}
						</p>
					</v-flex>
					@endif
					<v-flex xs12>
						<header>
							<h4>Info</h4>
							<hr>
						</header>
						<v-layout row>
							<v-flex xs12 md6>
								
							@if($page->category != null)
								<div>
									<h5>
										Category: <a href="/venues/category/{{$page->category_slug}}">{{$page->category}}</a>
									</h5>
								</div>
								@endif
								@if($page->website != null)
								<div>
									<h5>
										Website: <a href="{{$page->website}}" target="_blank">{{$page->website}}</a>
									</h5>
								</div>
								@endif

							</v-flex>

							<v-flex xs12 md6>
								
							@if($page->booking_email != null)
								<div>
									<h5>
										Email: <a href="mailto:{{$page->booking_email}}">{{$page->booking_email}}</a>
									</h5>
								</div>
								@endif
								@if($page->booking_number != null)
								<div>
									<h5>
										Phone: <a href="phone:{{$page->booking_number}}">{{$page->booking_number}}</a>
									</h5>
								</div>
								@endif

							</v-flex>

						</v-layout>
					</v-flex>
				</v-layout>
			</article>

		</v-container>

	</section>

</v-container>

@stop