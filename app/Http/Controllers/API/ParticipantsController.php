<?php

namespace App\Http\Controllers\API;

use App\Events\EventCreated;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParticipantRequest;
use App\Http\Resources\ParticipantResource;
use App\Jobs\SendEventNotification;
use App\Mail\EventAdded;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Traits\HasCacheTrait;
use App\Services\ParticipantService;

class ParticipantsController extends Controller
{
    use HasCacheTrait;

    protected ParticipantService $participantService;

    public function __construct(ParticipantService $participantService)
    {
        $this->participantService = $participantService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participant = $this->getFromCache('participants.all', function(){
            return $this->participantService->getAll();
        });

        return ParticipantResource::collection($participant);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantRequest $request)
    {
        $validateddata = $request->validated();
        $events = $request->input('events', []);

        $participant = $this->participantService->create($validateddata, $events);        

        EventCreated::dispatch($participant);

        // $participant = new Participant;
        // $participant->first_name = $validateddata['first_name'];
        // $participant->last_name = $validateddata['last_name'];
        // $participant->email = $validateddata['email'];
        // $participant->phone_number = $validateddata['phone_number'];
        // $participant->save();

        // $participant_events = $request->events;

        // $participant->events()->sync($participant_events);
        

        //email dispatch
        // foreach($participant->events as $event)
        // {            
        // SendEventNotification::dispatch($event, $participant)->onQueue('mail');
        // }

        return new ParticipantResource($participant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        $participant = $this->participantService->getById($participant->id);
        
        return new ParticipantResource($participant);

        // $participant->load('events.venue');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRequest $request, Participant $participant)
    {
        $validateddata = $request->validated();
        $events = $request->input('events', []);

        $participant = $this->participantService->update($participant, $validateddata, $events);

        return new ParticipantResource($participant);

        
        // $participant->update($validateddata);

        // $participant_events = $request->events;

        // $participant->events()->sync($participant_events);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        $this->participantService->delete($participant);        
        return new ParticipantResource($participant);

        // $participant->delete();
    }
}
