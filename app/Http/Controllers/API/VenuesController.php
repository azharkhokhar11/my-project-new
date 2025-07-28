<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VenueResource;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venues = Venue::with('events', 'images')->latest()->get();
        return VenueResource::collection($venues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $venue = new Venue();
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->phone_number = $request->phone_number;
        $venue->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('venues', 'public');

                $venue->images()->create([
                    'url' => $path,
                ]);
            }
        }

        return new VenueResource($venue);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        return new VenueResource($venue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        $venue->name = $request->name;
        $venue->address = $request->address;
        $venue->phone_number = $request->phone_number;
        $venue->update();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('venues', 'public');
    
                $venue->images()->create([
                    'url' => $path,
                ]);
            }
        }    
        return new VenueResource($venue);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venue $venue)
    {
        $venue->delete();
        return new VenueResource($venue);
    }
}
