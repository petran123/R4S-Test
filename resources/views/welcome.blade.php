@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
    
    <h1 class="mt-5">Welcome to Rent4Sure</h1>

    <div class="row pt-5">
        <div class="col-6">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eu dui in neque condimentum volutpat non vel magna. Vivamus imperdiet sollicitudin diam, nec venenatis elit gravida in. Morbi turpis leo, bibendum a tellus ac, ornare blandit massa. Pellentesque pulvinar volutpat aliquam. Nunc porta ex dolor, nec accumsan orci dignissim nec. Quisque ut enim erat. Donec ornare mauris vel turpis suscipit bibendum.</p>
        </div>

        <div class="col-6">
            <p>Sed quis diam blandit, iaculis enim vitae, ullamcorper orci. Integer sed consequat ipsum, vel placerat mi. Proin enim purus, mollis vel lobortis quis, consequat a libero. Nulla et ante scelerisque, blandit nisl a, porttitor sem. Mauris id hendrerit erat. Maecenas quis nisi eget justo commodo aliquam. Maecenas facilisis libero libero, non tempor eros hendrerit quis. Proin efficitur ex a libero pellentesque cursus. Pellentesque in nulla ac leo mattis lacinia.
        </div>
</div>

</div>
@endsection