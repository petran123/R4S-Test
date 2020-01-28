@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <a href="/properties/{{$property->id}}" class="btn r4s-button">Back</a>

            <h3 class="mt-4">Property Details</h3>
            <form method="POST" action="/properties/{{$property->id}}">
                @method('PATCH')
                @csrf
                

                <div class="form-group row">
                    <label for="address_line_1" class="col-md-4 col-form-label text-md-right">
                        {{ __('Address Line 1') }}
                    </label>
            
                    <div class="col-md-6 mt-2">
                        <input id="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" 
                        name="address_line_1" value="{{ old('address_line_1')?: $property->address_line_1 }}" 
                        required autocomplete="address_line_1" autofocus>
            
                        @error('address_line_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <label for="address_line_2" class="col-md-4 col-form-label text-md-right mt-2">
                        {{ __('Address Line 2') }}
                    </label>
            
                    <div class="col-md-6 mt-2">
                        <input id="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" 
                        name="address_line_2" value="{{ old('address_line_2')?: $property->address_line_2 }}" autocomplete="address_line_2" autofocus>
            
                        @error('address_line_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <label for="town" class="col-md-4 col-form-label text-md-right mt-2">{{ __('Town') }}</label>
            
                    <div class="col-md-6 mt-2">
                        <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" 
                        name="town" value="{{ old('town')?: $property->town }}" required autocomplete="town" autofocus>
            
                        @error('town')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <label for="county" class="col-md-4 col-form-label text-md-right mt-2">
                        {{ __('County') }}
                    </label>
            
                    <div class="col-md-6 mt-2">
                        <input id="county" type="text" class="form-control @error('county') is-invalid @enderror" 
                        name="county" value="{{ old('county')?: $property->county }}" required autocomplete="county" autofocus>
            
                        @error('county')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <label for="postcode" class="col-md-4 col-form-label text-md-right mt-2">
                        {{ __('Postcode') }}
                    </label>
            
                    <div class="col-md-6 mt-2">
                        <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" 
                        name="postcode" value="{{ old('postcode')?: $property->postcode }}" required autocomplete="postcode" autofocus>
            
                        @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
            
                    <label for="monthly_rent_in_gbp" class="col-md-4 col-form-label text-md-right mt-2">{{ __('Rent(£)') }}</label>
            
                    <div class="col-md-6 mt-2">
                        <input id="monthly_rent_in_gbp" type="number" class="form-control @error('monthly_rent_in_gbp') is-invalid @enderror" 
                        name="monthly_rent_in_gbp" value="{{ old('monthly_rent_in_gbp')?: $property->monthly_rent_in_gbp }}"
                         autocomplete="monthly_rent_in_gbp" autofocus>
            
                        @error('monthly_rent_in_gbp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn r4s-button">
                            {{ __('Update') }}
                        </button>
            
                    </div>
                </div>
            </form>

            <h3 class="mt-4" id="tenants">Current Tenants</h3>
            
            @foreach ($property->tenants as $tenant)
            <div class="row">
                
                <div class="col-3">
                    {{$tenant->given_name . " " . $tenant->family_name}}

                </div>
                    <div class="col-5">
                    <form method="POST" action="/tenants/{{$property->id}}/{{$tenant->id}}" class="form-group d-flex">
                        @csrf
                        @method('PATCH')
                        
                            <input class="form-control" type="number" name="share_of_rent_in_gbp" id="edit_share_of_rent" value="{{$tenant->share_of_rent_in_gbp}}" placeholder="share of rent(£)">

                            <button class="btn r4s-button" type="submit">Modify</button>
                    </form>
                </div>
                

                <div class="col-1">
                    <form method="POST" action="/tenants/{{$property->id}}/{{$tenant->id}}">
                        @method('DELETE')
                        @csrf
                        <button class="btn r4s-button" type="submit">Remove</button>
                    </form>
                </div>
            </div>
                @endforeach
            
        
            <h3 class="mt-4">Add Tenants</h3>
            <form action="/tenants/{{$property->id}}/" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                        <input class="form-control @error('given_name') is-invalid @enderror" type="text" name="given_name" id="new_given_name" placeholder="Given Name" required>

                        @error('given_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col">
                        <input class="form-control @error('family_name') is-invalid @enderror" type="text" name="family_name" id="new_family_name" placeholder="Family Name" required>
                        @error('family_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col">
                        <input class="form-control @error('share_of_rent_in_gbp') is-invalid @enderror" type="number" name="share_of_rent_in_gbp" id="share-of-rent" placeholder="share of rent(£)" required>
                        @error('share_of_rent_in_gbp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col">
                        <button class="btn r4s-button" type="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection