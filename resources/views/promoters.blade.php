@extends('layouts.guest')

@section('content')

<v-container grid-list-md>
	<header>
		<h1>Promoters</h1>
	</header>

	<section>
		<v-layout row wrap>
			@foreach($promoters as $promoter)
			<v-flex md4 xs12>
				<v-card  color="blue" class="card text-xs-center flexed white--text padded" data-ripple='true' style="height: 300px; display: flex; align-items: center; justify-content: center; position: relative; overflow: auto;">
					<div>
						<h4>{{$promoter->name}}</h4>
						<p>
							{{$promoter->location}}
						</p>
					</div>

					<div class="text-xs-right absolute bottom-right">
						<v-btn fab raised class="blue darken-4 white--text" href="/promoters/{{$promoter->slug}}" title="Visit {{$promoter->name}}'s RYT profile.">
							Visit
						</v-btn>
					</div>

				</v-card>
			</v-flex>		
			@endforeach
		</v-layout>

		<div class="text-xs-center">
			{{$promoters->links()}}
		</div>	
	</section>
</v-container>

@stop