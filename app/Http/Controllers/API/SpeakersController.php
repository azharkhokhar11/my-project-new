<?php

namespace App\Http\Controllers\API;

use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpeakerResource;

class SpeakersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speaker = Speaker::with('events')->latest()->get();
        return SpeakerResource::collection($speaker);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'email' => 'required|email|unique:speakers,email',
            'phone_number' => 'required|string|max:20',
        ]);

        $speaker = new Speaker;
        $speaker->first_name = $validateddata['first_name'];
        $speaker->last_name = $validateddata['last_name'];
        $speaker->email = $validateddata['email'];
        $speaker->phone_number = $validateddata['phone_number'];
        $speaker->save();

        $speaker_events = $request->events;

        $speaker->events()->sync($speaker_events);


        return new SpeakerResource($speaker);
    }

    /**
     * Display the specified resource.
     */
    public function show(Speaker $speaker)
    {
        return new SpeakerResource($speaker);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speaker $speaker)
    {
        $validateddata = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:speakers,email',
            'phone_number' => 'required|string|max:20',
        ]);

        $speaker = new Speaker;
        $speaker->first_name = $validateddata['first_name'];
        $speaker->last_name = $validateddata['last_name'];
        $speaker->email = $validateddata['email'];
        $speaker->phone_number = $validateddata['phone_number'];
        $speaker->update();

        $speaker_events = $request->events;

        $speaker->events()->sync($speaker_events);

        return new SpeakerResource($speaker);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speaker $speaker)
    {
        $speaker->delete();
        return new SpeakerResource($speaker);
    }
}
