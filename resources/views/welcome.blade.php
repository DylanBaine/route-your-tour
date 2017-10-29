@extends('layouts.guest')

@section('content')
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
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
