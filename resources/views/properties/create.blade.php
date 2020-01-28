@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <a class="btn r4s-button" href="/properties">Back</a>
            </div>

            <form method="POST" action="/properties">
                @csrf

                <div class="form-group row">
                    <label for="address_line_1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                    <div class="col-md-6">
                        <input id="address_line_1" type="text" class="form-control @error('address_line_1') is-invalid @enderror" name="address_line_1" value="{{ old('address_line_1') }}" required autocomplete="address_line_1" autofocus>

                        @error('address_line_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="address_line_2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>

                    <div class="col-md-6">
                        <input id="address_line_2" type="text" class="form-control @error('address_line_2') is-invalid @enderror" name="address_line_2" value="{{ old('address_line_2') }}" autocomplete="address_line_2" autofocus>

                        @error('address_line_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('Town') }}</label>

                    <div class="col-md-6">
                        <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{ old('town') }}" required autocomplete="town" autofocus>

                        @error('town')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="county" class="col-md-4 col-form-label text-md-right">{{ __('County') }}</label>

                    <div class="col-md-6">
                        <input id="county" type="text" class="form-control @error('county') is-invalid @enderror" name="county" value="{{ old('county') }}" required autocomplete="county" autofocus>

                        @error('county')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                    <div class="col-md-6">
                        <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode" autofocus>

                        @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="monthly_rent_in_gbp" class="col-md-4 col-form-label text-md-right">{{ __('Rent(GBP)') }}</label>

                    <div class="col-md-6">
                        <input id="monthly_rent_in_gbp" type="number" class="form-control @error('monthly_rent_in_gbp') is-invalid @enderror" name="monthly_rent_in_gbp" value="{{ old('monthly_rent_in_gbp') }}" autocomplete="monthly_rent_in_gbp" autofocus>

                        @error('monthly_rent_in_gbp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>

                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

@endsection