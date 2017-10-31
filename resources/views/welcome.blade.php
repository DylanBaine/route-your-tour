@extends('layouts.guest')

@section('content')
@if ($errors->any())
    <v-alert color='error' icon="warning" value="true" v-show="errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <v-card-actions>
        	<v-spacer></v-spacer><v-btn fab class="red darken-3" @click="errors = false"><v-icon>close</v-icon></v-btn>
        </v-card-actions>
    </v-alert>
@endif

<welcome-header>
</welcome-header>

<about-section>
</about-section>

<top-users-section>
</top-users-section>

<closing-footer>
</closing-footer>

@stop
