@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>My Properties</h1>
            <div class="d-flex">
                
                <div>
                    <a class="btn r4s-button" href="/properties/create">Create</a>
                </div>

                <div>
                    <form  method="GET" action="/properties">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-5">
                                    <select class="form-control" name="filter" id="filter">
                                        <option value="address_line_1">Address</option>
                                        <option value="town" {{$request->filter == "town"? "selected" : ""}}>Town</option>
                                        <option value="postcode" {{$request->filter == "postcode"? "selected" : ""}}>Postcode</option>
                                    </select>
                                </div>
                                <div class="col-5">
                                    <select class="form-control" name="order" id="order">
                                        <option value="asc">Ascending</option>
                                        <option value="desc" {{$request->order == "desc"? "selected" : ""}}>Descending</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="btn r4s-button" type="submit">Sort</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th scope="col">Address</th>
                        <th scope="col">Town</th>
                        <th scope="col">Postcode</th>
                    </tr>
                </thead>
                @foreach ($properties as $property)
                    <tr class="property-list" data-href="/properties/{{$property->id}}">
                        <td>{{$property->address_line_1}}</td>
                        <td>{{$property->town}}</td>
                        <td>{{$property->postcode}}</td>
                    </tr>
                @endforeach
            </table>
            
        </div>
    </div>
</div>


@endsection