<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProperty;
use App\Http\Requests\UpdateProperty;
use App\Property;
use App\Tenant;
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
    public function index(Request $request)
    {
        $title = "My Properties | Rent4Sure";

        $sort = $request->input('sort') ?: 'address_line_1';
        $order = $request->input('order') ?: 'asc';

        $properties = Auth::user()->properties()->orderby($sort, $order)->get();

        return view('properties.index', compact('title', 'request', 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create a Property | Rent4Sure";

        return view('properties.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProperty $request)
    {
        $validatedData = $request->validated();
        $validatedData['manager_id'] = Auth::id();

        $property = Property::create($validatedData);

        return redirect()->route('properties.show', [$property]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $title = "{$property->address_line_1}} | Rent4Sure";
        if (Gate::allows('manage-property', $property))
            return view('properties.show', compact('title', 'property'));

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

            $title = "Edit | Rent4Sure ";

            $unusedTenants = Tenant::where('property_id', null)->get();

            return view('properties.edit', compact('title', 'property', 'unusedTenants'));
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
    public function update(UpdateProperty $request, Property $property)
    {
        
        if (Gate::allows('manage-property', $property)) {
            $property->update($request->validated());
            return redirect()->route('properties.show', [$property]);
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
            return redirect()->route('properties.index');
        }

        abort(403);
    }
}
