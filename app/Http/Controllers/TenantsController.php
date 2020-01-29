<?php

namespace App\Http\Controllers;

use App\Property;
use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TenantsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property $property
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        if (Gate::allows('manage-property', $property)) {
            $validatedData = $this->validateData($request);
            $validatedData['property_id'] = $property->id;

            Tenant::create($validatedData);

            return redirect()->route('properties.edit', [$property]);
        }

        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property, Tenant $tenant)
    {
        if (Gate::allows('manage-property', $property)) {
            $validated = $request->validate(['share_of_rent_in_gbp_edit' => ['integer', 'min:0', 'nullable']]);
            $newRent['share_of_rent_in_gbp'] = $validated['share_of_rent_in_gbp_edit'];
            
            $tenant->update($newRent);
            return redirect()->route('properties.edit', [$property]);
        }

        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Property $property
     * @param  \App\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property, Tenant $tenant)
    {
        if (Gate::allows('manage-property', $property)) {
            $tenant->delete();

            return redirect()->route('properties.edit', [$property]);
        }

        abort(403);
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'given_name' => ['alpha', 'required'],
            'family_name' => ['alpha', 'required'],
            'share_of_rent_in_gbp' => ['integer', 'min:0', 'nullable']
        ]);
    }
}
