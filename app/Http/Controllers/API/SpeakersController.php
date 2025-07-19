<?php

namespace App\Http\Controllers\API;

use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Traits\HasCacheTrait;
use App\Services\SpeakerService;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpeakerResource;
use App\Http\Requests\ParticipantRequest;

class SpeakersController extends Controller
{
    use HasCacheTrait;

     protected SpeakerService $speakerService;

    public function __construct(SpeakerService $speakerService)
    {
        $this->speakerService = $speakerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $speaker = $this->getFromCache('speakers.all', function(){
            return $this->speakerService->getAll();;
        });

        return SpeakerResource::collection($speaker);
        
        // $speaker = Speaker::with('events')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ParticipantRequest $request)
    {
        $validateddata = $request->validated();
        $events = $request->input('events', []);

        $speaker = $this->speakerService->create($validateddata, $events);


        return new SpeakerResource($speaker);
        

        // $speaker = new Speaker;
        // $speaker->first_name = $validateddata['first_name'];
        // $speaker->last_name = $validateddata['last_name'];
        // $speaker->email = $validateddata['email'];
        // $speaker->phone_number = $validateddata['phone_number'];
        // $speaker->save();

        // $speaker_events = $request->events;

        // $speaker->events()->sync($speaker_events);
    }

    /**
     * Display the specified resource.
     */
    public function show(Speaker $speaker)
    {
        $speaker = $this->speakerService->getById($speaker->id);
        return new SpeakerResource($speaker);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ParticipantRequest $request, Speaker $speaker)
    {
        $validateddata = $request->validated();
        $events = $request->input('events', []);

        $speaker = $this->speakerService->update($speaker, $validateddata, $events);

         return new SpeakerResource($speaker);

        // $speaker = new Speaker;
        // $speaker->first_name = $validateddata['first_name'];
        // $speaker->last_name = $validateddata['last_name'];
        // $speaker->email = $validateddata['email'];
        // $speaker->phone_number = $validateddata['phone_number'];
        // $speaker->update();

        // $speaker_events = $request->events;

        // $speaker->events()->sync($speaker_events);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speaker $speaker)
    {
        $this->speakerService->delete($speaker);        

        return new SpeakerResource($speaker);

        // $speaker->delete();
    }
}
