@extends('layouts.app')

@section('content')
<div class="d-flex">
<div>
    <a class="btn r4s-button" href="/properties">Back</a>
</div>

<div>
    <a class="btn r4s-button" href="/properties/{{$property->id}}/edit">Edit</a>
</div>

<form method="POST" action="/properties/{{$property->id}}/delete">
    @csrf
    @method('DELETE')
    <button class="btn r4s-button" type="submit">Delete</button>
</form>
</div>

<div class="property-details-container">
    <div class="property-detail">{{$property->address_line_1}}</div>
    <div class="property-detail">{{$property->address_line_2}}</div>
    <div class="property-detail">{{$property->town}}</div>
    <div class="property-detail">{{$property->county}}</div>
    <div class="property-detail">{{$property->postcode}}</div>
    <div class="property-detail">rent: £{{$property->monthly_rent_in_gbp}}</div>
    Tenants to be added
</div>
@endsection