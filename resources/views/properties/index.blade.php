@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div>
                <a class="btn r4s-button" href="/properties/create">Create</a>
            </div>
            
@foreach ($properties as $property)
<a href="/properties/{{$property->id}}">
    <div class="card">
    <div class="property-item">
        <div class="property-content">{{$property->address_line_1}}</div>
        <div class="property-content">{{$property->town}}</div>
        <div class="property-content">{{$property->postcode}}</div>
    </div>
</div>
</a> 
@endforeach
            
        </div>
    </div>
</div>


@endsection