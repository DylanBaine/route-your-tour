@component('mail::message')

<img src="{{url('Defaults\logo-black.png')}}" alt="">

# Welcome to the club, {{$name}}!

@component('mail::button', ['url' => $url ])
CLICK HERE TO VERIFY YOUR EMAIL
@endcomponent


@endcomponent