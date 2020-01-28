@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex">
                <div>
                    <a class="btn r4s-button" href="/properties">Back</a>
                </div>

                

                {{-- Modal --}}
                <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Are you sure? This cannot be reversed, and the associated tenants will be deleted.
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                          <form method="POST" action="/properties/{{$property->id}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn r4s-button" type="submit">Delete</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>

            <div class="property-details-container">
                
                <div class="row mt-4">
                    <h3 class="">Property Details</h3>

                    <div class="ml-2">
                        <a class="btn r4s-button" href="/properties/{{$property->id}}/edit">Edit</a>
                    </div>

                    <div>
                        <button type="button" class="btn r4s-button" data-toggle="modal" data-target="#confirmDelete">Delete</button>
                    </div>
                </div>
                <table class="table table-hover">
                    <tr>
                        <th scope="row">Address Line 1:</th>
                        <td class="ml-auto">{{$property->address_line_1}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Address Line 2:</th>
                        <td class="ml-auto">{{$property->address_line_2?: "not set"}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Town:</th>
                        <td class="ml-auto">{{$property->town}}</td>
                    </tr>
                    <tr>
                        <th scope="row">County:</th>
                        <td class="ml-auto">{{$property->county}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Postcode</th>
                        <td class="ml-auto">{{$property->postcode}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total Monthly Rent:</th>
                        <td class="ml-auto">{{$property->monthly_rent_in_gbp? "£" . $property->monthly_rent_in_gbp : "not set"}}</td>
                    </tr>
                </table>

                <div class="row">
                    <h3>Tenants</h3>
                    
                    <div>
                        <a class="btn r4s-button ml-2" href="/properties/{{$property->id}}/edit#tenants">Edit</a>
                    </div>
                </div>
                @if(!$property->tenants->isEmpty())
                
                <table class="table table-hover mt-2">
                    <tr>
                        <th>Given Name</th>
                        <th>Family Name</th>
                        <th>Share of Rent</th>
                    </tr>
                    @foreach ($property->tenants as $tenant)
                        <tr>
                            <td>{{$tenant->given_name}}</td>
                            <td>{{$tenant->family_name}}</td>
                            <td class="pl-5">£{{$tenant->share_of_rent_in_gbp?: 0}}</td>
                        </tr>
                    @endforeach
                </table>
                @else
                </div>
                    <p>No Tenants have been assigned to this property.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection