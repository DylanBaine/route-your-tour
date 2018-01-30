@extends('layouts.app')

@section('content')
<v-container>
    @if (session('status'))
        <v-alert icon="error" value="true">
            {{ session('status') }}
        </v-alert>
    @endif
    <v-layout row wrap style="margin-top: 100px;">
        <v-flex md6 offset-md3>
            <v-card class="padded">
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div>
                        <h3>Reset your Password</h3>
                    </div>

                    <v-card-text>
                        <v-text-field
                            name="email"
                            label="Email"
                            autofocus
                            value="{{old('email')}}"
                            >
                        </v-text-field>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary">Send Password Reset Link</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-flex>
    </v-layout>
</v-container>
@endsection
