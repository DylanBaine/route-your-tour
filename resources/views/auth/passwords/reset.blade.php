@extends('layouts.app')

@section('content')
<v-container>
	<v-layout style="margin-top: 100px;" row wrap>
		<v-flex md6 offset-md3>
			<v-card class="padded">
			    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">

			        {{ csrf_field() }}

			        <input type="hidden" name="token" value="{{ $token }}">

			        	<div>
			        		<h3>Set a new password.</h3>
			        	</div>
			        	<v-card-text>

			                <v-text-field
								name="email"
								value="{{$email || old('email')}}"
								required autofocus
								label="Email"
			                	>
			                </v-text-field>

			                @if ($errors->has('email'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('email') }}</strong>
			                    </span>
			                @endif

			                <v-text-field
			                	name="password"
			                	label="Password"
			                	required
			                	type="password"
			                	>
			                </v-text-field>

			                @if ($errors->has('password'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('password') }}</strong>
			                    </span>
			                @endif

			                <v-text-field
			                	type="password"
			                	name="password_confirmation"
			                	label="Confirm Password"
			                	>
			                </v-text-field>

			                @if ($errors->has('password_confirmation'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('password_confirmation') }}</strong>
			                    </span>
			                @endif
			            </v-card-text>

			            <v-card-actions>
			            	<v-spacer></v-spacer>
			                <v-btn type="submit" color="primary">Set Password</v-btn>
			            </v-card-actions>
			    </form>
			</v-card>
		</v-flex>
	</v-layout>

</v-container>

@endsection
