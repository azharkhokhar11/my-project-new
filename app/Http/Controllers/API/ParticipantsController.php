<?php

namespace App\Http\Controllers\API;

use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ParticipantResource;

class ParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participant = Participant::with('events.venue')->latest()->get();
        return ParticipantResource::collection($participant);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateddata = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:participants,email',
            'phone_number' => 'required|string|max:20',
        ]);
        $participant = new Participant;
        $participant->first_name = $validateddata['first_name'];
        $participant->last_name = $validateddata['last_name'];
        $participant->email = $validateddata['email'];
        $participant->phone_number = $validateddata['phone_number'];
        $participant->save();

        $participant_events = $request->events;

        $participant->events()->sync($participant_events);

        return new ParticipantResource($participant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        $participant->load('events.venue');
        return new ParticipantResource($participant);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        $validateddata = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:participants,email',
            'phone_number' => 'required|string|max:20',
        ]);

        $participant->update($validateddata);

        $participant_events = $request->events;

        $participant->events()->sync($participant_events);

        return new ParticipantResource($participant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return new ParticipantResource($participant);
    }
}
