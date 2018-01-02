<template>
	<v-container fluid grid-list-xl>
		<loader v-if="loading">Finding all of your stuff</loader>
		<header class="text-xs-center padded">
			<h4 >Welcome to your profiles page.</h4>
			<h6>This is where all of your pages are listed. You can also add new pages from here.</h6>
			<small> You have {{activeBands}} bands, and {{activeVenues}} venues  active right now.</small>

			<v-btn to="add-tour" color="primary" class="padded">
				Route Your Tour Now! <v-icon>add</v-icon>
			</v-btn>
		</header>

		<hr>

		<section v-if="!loading" id="profile-options" class="padded">

			
			<v-layout row wrap id="profiles">
				<v-flex md3 xs6 v-for="item in items" :key="item.id" >
					<v-card data-ripple="true" :to="'/profiles/add/' + item.name" :color="item.color" class="card text-xs-center flexed white--text">
						<div>
							<v-icon xl>{{item.icon}}</v-icon>
							<br>
							<v-flex hidden-xs-only>{{item.desc}}</v-flex>
						</div>
					</v-card>
				</v-flex>
			</v-layout>

		</section>

		<hr>
		
		</div>

		<section id="profiles" class="padded">

			<header class="padded">
				<h3>Band profiles you run.</h3>
			</header>

			<div v-if="bands.length < 1" id="noBands">
				<div class="inner">					
					<div>				
						<h3 class="white--text">No bands added yet... :(</h3>
						<v-btn to="/profiles/add/Band" color="primary">
							<v-icon>add</v-icon>
							ADD A BAND PROFILE
						</v-btn>
					</div>
				</div>
			</div>
			
			<v-layout row wrap id="bands">
				<v-flex md4 xs12 v-for="band in bands" :key="band.id" >
					<v-card :to="'/band/' + band.slug" color="orange" class="card text-xs-center flexed white--text">
						{{band.name}}
					</v-card>
				</v-flex>
			</v-layout>

			<header class="padded">
				<h3>Venue profiles you run.</h3>
			</header>

			<div v-if="venues.length < 1" id="noVenues">
				<div class="inner">
					<div>				
						<h3 class="white--text">No venues added. Feel free to add a venue.</h3>
						<v-btn to="/profiles/add/Venue" color="primary">
							<v-icon>add</v-icon>
							ADD A VENUE PROFILE
						</v-btn>
					</div>
				</div>
			</div>
			
			<v-layout row wrap id="venues">
				<v-flex md4 xs12 v-for="venue in venues" :key="venue.id" >
					<v-card :to="'/venue/' + venue.slug" color="green" class="card text-xs-center flexed white--text">
						{{venue.name}}
					</v-card>
				</v-flex>
			</v-layout>

			<v-layout row wrap id="promoter-booking-agent">				
				<v-flex md6 v-show="promoter.name">
					<header class="padded">
						<h3>Your Promoter Profile.</h3>
					</header>

					<v-card to="/promoter/" color="blue" class="card text-xs-center flexed white--text">
						{{promoter.name}}
					</v-card>
				</v-flex>

				<v-flex md6 v-show="bookingAgent.name">
					<header class="padded">
						<h3>Your Booking Agent Profile.</h3>
					</header>

					<v-card to="/booking-agent/" color="deep-purple" class="card text-xs-center flexed white--text">
						{{bookingAgent.name}}
					</v-card>
				</v-flex>
			</v-layout>

		</section>

	</v-container>
</template>

<script>
export default{
	data(){
		return{
			items: [
				{
					id: 1,
					name: 'Band',
					color: 'orange',
					icon: 'music_note',
					desc: 'Add a Band to your account.'
				},
				{
					id: 2,
					name: 'Venue',
					color: 'green',
					icon: 'store',
					desc: 'Add a Venue to your accout.'
				},
				{
					id: 3,
					name: 'Promoter',
					color: 'blue',
					icon: 'business_center',
					desc: 'Become a Route Your Tour Promoter.'
				},
				{
					id:4,
					name: 'BookingAgent',
					color: 'deep-purple',
					icon: 'library_books',
					desc: 'Become a Route Your Tour Booking Agent.'
				}
			],
			bands: [],
			venues: [],	
			promoter: '',
			bookingAgent: '',
			loading: true
		}

	},
	mounted(){
		axios.get('/api/users-bands')
			.then(response => this.bands = response.data);

			this.$nextTick(function(){

				axios.get('/api/users-venues')
					.then(response => this.venues = response.data);	

				this.$nextTick(function(){

					axios.get('/api/users-promoter')
						.then(response => this.promoter = response.data);

					this.$nextTick(function(){

						axios.get('/api/users-bookingagent')
							.then(response => this.bookingAgent = response.data);

					})
				})
			})
	},
	updated(){
		this.loading = false;
	},
	computed: {
		activeBands: function(){
			return this.bands.length;
		},
		activeVenues: function(){
			return this.venues.length;
		},
		queryLength: function(){
			return this.venues.length + this.bands.length
		}		
	},

}
		
</script>

<style scoped>
	#noBands, #noVenues{
		border-radius: 10px;
		width: 100%;
		height: 300px;
		margin: 20px 0px;
		background-position: center;
		background-size: cover;
	}
	#noBands .inner, #noVenues .inner{
		border-radius: 10px;
		padding: 40px;
		width: 100%;
		height: 100%;
		display: flex;
		align-items: center;
		background-image: linear-gradient(95deg, rgba(0,0,0,.7), rgba(0,0,0,.3));	
	}
	#noBands{
		background-image: url('/Defaults/bands-banner.jpg');
	}
	#noVenues{
		background-image: url('/Defaults/diamond-banner.jpg');
	}
	.card{
		height: 220px !important;
		padding: 10px;
	}
	.flexed{
		display: flex;
		justify-content: center;
		align-items: center;
	}	
	.oh-no{
		padding: 80px;
	}
	@media (max-width: 599px){
		.card{
			height: auto !important;
		}
	}
</style>