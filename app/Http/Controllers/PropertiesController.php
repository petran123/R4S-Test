<?php

namespace App\Http\Controllers;

use App\Property;
use App\Tenant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PropertiesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $filter = $request->input('filter') ?: 'address_line_1';
        $order = $request->input('order') ?: 'asc';

        $properties = Property::where('manager_id', Auth::id())->orderBy($filter, $order)->get();
        // $properties = $user->properties;
        // orderBy($filter, $order)->get();

        return view('properties.index', [
            'request' => $request,
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $this->validateData($request);
        $validatedData['manager_id'] = Auth::id();

        $property = Property::create($validatedData);

        return redirect("/properties/{$property->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        if (Gate::allows('manage-property', $property))
            return view('properties.show', ['property' => $property]);

        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        if (Gate::allows('manage-property', $property)) {
            $unusedTenants = Tenant::where('property_id', null)->get();

            return view('properties.edit', [
                'property' => $property,
                'unusedTenants' => $unusedTenants
                ]);
        }

        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        if (Gate::allows('manage-property', $property)) {
            $property->update($this->validateData($request));
            return redirect("properties/{$property->id}");
        }

        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if (Gate::allows('manage-property', $property)) {
            $property->delete();
            return redirect('properties');
        }

        abort(403);
    }

    /**
     * Remove tenant from property
     * 
     * @param \App\User $user
     * @param \App\Property $property
     * @param \App\Tenant $tenant
     * 
     * @return \Illuminate\Http\Response
     */
    public function removeTenant(Property $property, Tenant $tenant)
    {
        if (Gate::allows('manage-property', $property)) {
            $tenant->property_id = null;
            $tenant->save();

            return redirect("properties/{$property->id}/edit" );
        }

        abort(403);
    }

    public function updateTenant(Request $request, Property $property, Tenant $tenant)
    {
        dd('doesn\'t work yet');
        if (Gate::allows('manage-property', $property)) {
            $tenant->share_of_rent_in_gbp = $request->validate(['share_of_rent_in_gbp' => ['required', 'numeric']]);
            $tenant->save();
            return redirect("properties/{$property->id}/edit" );
        }

        abort(403);
    }


    private function validateData($request)
    {
        return $request->validate([
            'address_line_1' => ['required', 'alpha_num_spaces_dashes'],
            'address_line_2' => ['alpha_num_spaces_dashes', 'nullable'],
            'town' => ['required', 'alpha'],
            'county' => ['required', 'alpha'],
            'postcode' => ['required'],
            'monthly_rent_in_gbp' => ['numeric', 'nullable']
        ]);
    }
}
