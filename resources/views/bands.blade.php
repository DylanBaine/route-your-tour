@extends('layouts.guest')

@section('content')
<header>

</header>
	<v-container fluid grid-list-xl>
		<v-layout row wrap>
			@foreach($bands as $band)
			<v-flex md4 xs12>
				<v-card  color="blue" class="card text-xs-center flexed white--text padded" data-ripple='true' style="height: 300px; display: flex; align-items: center; justify-content: center; position: relative; overflow: auto;">
					<div>

						<h4>{{$band->name}}</h4>
						<br>
						<h5>{{$band->address}}</h5>

					</div>

					<div class="text-xs-right absolute bottom-right">
						<v-btn fab raised class="blue darken-4 white--text" href="bands/{{$band->slug}}" title="Visit {{$band->name}}'s RYT profile.">
							Visit
						</v-btn>
					</div>

				</v-card>
			</v-flex>		
			@endforeach
		</v-layout>
	</v-container>
	<div class="text-xs-center">
		{{$bands->links()}}
	</div>

</v-container>
@stop