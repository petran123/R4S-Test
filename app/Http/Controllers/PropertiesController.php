<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(User $user)
    {
        $properties = Property::where('user_id', Auth::id())->get();

        return view('properties.index', [
            'properties' => $properties]
        );
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
        
        $validatedData = $request->validate([
            'address_line_1' => ['required', 'alpha_num'], 
            'address_line_2' => ['alpha_num'],
            'town' => ['required', 'alpha'],
            'county' => ['required', 'alpha'],
            'postcode' => ['required'],
            'monthly_rent_in_gbp' => ['numeric']
        ]);
        

        $validatedData['user_id'] = Auth::id();
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
        if (Auth::id() != $property->owner->id)
            abort(403);

        return view('properties.show', ['property' => $property]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        if ($property->user_id != Auth::id())
            abort(403);

        return view('properties.edit', ['property' => $property]);

        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        // TODO add deletion confirmation, and success message
        if ($property->user_id != Auth::id()) 
            abort(403);
        

        $property->delete();
        return redirect('properties');

    }
}
