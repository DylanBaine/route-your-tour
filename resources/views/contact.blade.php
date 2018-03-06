@extends('layouts.guest')

@section('content')
<v-container>
	<header class="padded text-xs-center">
		<h1>Contact us</h1>
		<h3>New feature idea? Found a bug? Need a friend? Fill out the form and we'll talk.</h3>
	</header>
	<section class="padded">
		<v-layout justify-center align-center>
			<div style="max-width: 95%; width:800px; margin-top: 40px;">
				<form action="/contact-form" method="post">
					{{csrf_field()}}
					<v-text-field
						name="name"
						label="Your Name"
						required
					></v-text-field>
					<v-text-field
						name="email"
						label="Your Email"
						type="email"
						required
					></v-text-field>
					<v-text-field
						name="message"
						label="Message"
						multi-line
						required
					></v-text-field>
					<div>						
						<v-btn type="submit" block primary>Send</v-btn>
					</div>
				</form>
			</div>
		</v-layout>
	</section>
</v-container>
@stop