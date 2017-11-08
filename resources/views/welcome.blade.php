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

<header id="hero">
    <div id="inner">        
        <div id="title">
            <div class="hero-text">
                <h1 class="white--text">Welcome to Route Your Tour</h1>
                <h3 class="white--text">The visual route builder for bands.</h3>
            </div>
        </div>
    </div>
</header>

<section id="about" class="padded layout row wrap">
    <div class="padded flex xs12 md6 flex-center">
        <div>
            <h3>A place for booking agents, promoters, venues, and bands to connect.</h3>
            <h5>With a database of over 10,000 venues, and our visual route building tool, it's easy for users to work together and map out the perfect tour.</h5>            
        </div>
    </div> 
    <div class="padded flex xs12 md6">
        <img src="/Defaults/logo-black.png" alt="Route Your Tour" width="100%">
    </div> 
</section>

<div class="text-xs-center relative neg-top">
    <v-btn large raised href="/register" class="blue darken-1 white--text">Sign up for free.</v-btn>
</div>

<section id="bands" class="layout row wrap">
    <div class="flex md6 xs12 flex-center">
        <img src="https://scontent-dft4-1.xx.fbcdn.net/v/t31.0-8/11115712_836957499730117_8681454111825338210_o.jpg?oh=6057f7fbb77cfd533d392cb8dadbcd3e&oe=5AAB6B3B" alt="Route Your Tour Bands" width="100%">
    </div>
    <div class="padded flex md6 xs12 flex-center">
        <div>
            <h3 class="text-xs-right">Many touring bands already use Route Your Tour to organize their tours.</h3>
            <h5 class="text-xs-center">Kick-start your music career with our pre-espablished relationships with hundreds of touring bands, booking agents, and venues.</h5>
        </div>
    </div>    
</section>

<div class="relative neg-top" style="margin-left: 30px;">
    <v-btn large raised href="/venues" class="green darken-1 white--text">All of our venues.</v-btn>
</div>

<section id="video-cta" class="layout row wrap">
    <div class="padded flex md6 xs12 flex-center">
        <div>
            <h3>Route Your Tour was built by musicians for musicians.</h3>
            <h5>Touring is hard. Get ahead of everyone else by utilizing our tools. Stop dreaming of what you could do, and start doing what you can do.</h5>            
        </div>
    </div> 
    <div class="flex md6 xs12">
        <iframe width="100%" height="350" src="https://www.youtube.com/embed/6zPT1IiHvaQ" frameborder="0" allowfullscreen></iframe>
    </div> 
</section>

<div class="text-xs-right relative neg-top" style="margin-right: 30px;">
    <v-btn large raised href="/register" class="blue darken-1 white--text">Sign up for a free account.</v-btn>
</div>

@stop
