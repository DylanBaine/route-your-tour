@extends('layouts.guest')

@section('content')

<v-container grid-list-xl>
	<header class="padded">
		<h1>What you can do.</h1>
		<h4 class="padded">
			Route Your Tour is here to make touring in the music industry easier. Sign up for a free account to try it out, or pick the plan that fits your needs.
		</h4>
	</header>
	<v-layout row wrap class="">
		<v-flex md4>
			<v-card class="padded">
				<div class="heading">
					<br>
					<h4>Free and always free</h4>
					<br>
				</div>

				<hr>

				<v-card-text class="text-xs-left">
					<header>
						<h5>
							Try it out as long as you want!
						</h5>
					</header>
					<ul>
						<li>
							One of the following profiles
							<ul>
								<li>Public Band Profile</li>
								<li>Public Promoter Profile</li>
								<li>Public Booking Agent Profile</li>
							</ul>
						</li>
						<li>
							Save one private tour for a band profile.
						</li>
						<li>
							A Private Venue Profile
							<ul>
								<li>Create a profile page to share with fans.</li>
								<li>A private page will not show up in search results.</li>
							</ul>
						</li>
					</ul>
				</v-card-text>
				<br>
				<hr>
				<div class="text-xs-center">
					<h5>
						FREE
					</h5>
				</div>

				<v-card-actions>
					<v-btn href="/register" block class="grey darken-3" dark>Sign Up Now</v-btn>
				</v-card-actions>
				
			</v-card>
		</v-flex>
		<v-flex md4>
			<v-card class="padded">
				<div class="heading">
					<br>
					<h4>Starter</h4>
					<br>
				</div>

				<hr>

				<v-card-text class="text-xs-left">
					<header>
						<h5>
							For beginners in the industry.
						</h5>
					</header>
					<ul>
						<li>
							No Advertisements.
						</li>
						<li>
							One of each of the following profiles.
							<ul>
								<li>Public Band Profile</li>
								<li>Public Promoter Profile</li>
								<li>Public Booking Agent Profile</li>
							</ul>
						</li>
						<li>
							Save one public tour for a band profile.
						</li>
						<li>
							A Private Venue Profile
							<ul>
								<li>Create a profile page to share with fans.</li>
								<li>A private page will not show up in search results.</li>
							</ul>
						</li>						
					</ul>
				</v-card-text>

				<hr>
				<div class="text-xs-center">
					<h5>
						<!-- $5/mo -->
					</h5>
				</div>

				<v-card-actions>
					<v-btn disabled block color="success">Coming Soon</v-btn>
				</v-card-actions>
				
			</v-card>			
		</v-flex>
		<v-flex md4>
			<v-card class="padded">
				<div class="heading">
					<br>
					<h4>Premium</h4>
					<br>
				</div>

				<hr>

				<v-card-text class="text-xs-left">
					<header>
						<h5>
							For agents, venues, and musicians.
						</h5>
					</header>
					<ul>
						<li>
							No advertisements.
						</li>
						<li>As many band profiles as you want.</li>
						<li>
							One of each of the following.
							<ul>
								<li>Booking Agent Profile</li>
								<li>Promoter Profile</li>
							</ul>
						</li>
						<li>
							Save as many public tours as you want.
						</li>
						<li>
							As many public venu profiles as you want.
							<ul>
								<li>Create a profile page to share with fans.</li>
								<li>A public page will show up in search results.</li>
							</ul>
						</li>						
					</ul>

				</v-card-text>

				<hr>
				<div class="text-xs-center">
					<h5>
						<!-- $15/mo -->
					</h5>
				</div>

				<v-card-actions>
					<v-btn disabled block class="amber darken-4">Coming Soon</v-btn>
				</v-card-actions>
				
			</v-card>			
		</v-flex>
	</v-layout>
</v-container>

@stop