<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>{{env('app_name')}}</title>


        <link rel="icon"
            type="image/png" 
            href="storage/defaults/logo-black.png">
        
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" v-cloak>
            <v-app>
                @yield('content')
            </v-app>
        </div>
        <footer class="layout row grey darken-4 padded text-xs-center white--text">
            <div class="flex md4">footer</div>
            <div class="flex md4">footer</div>
            <div class="flex md4">footer</div>
        </footer>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>