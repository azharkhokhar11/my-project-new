<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use Psy\Readline\Hoa\EventSource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Event::class);
        $events = Event::with('venue:id,name','participants')->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Event::class);
        $request->validate([
            'name' => ['required','unique:events'],
            'description' => ['required'],
            'date' => ['required','date',Rule::date()->format('y-m-d')],
            'venue_id' => ['required','exists:venues,id'],
            'user_id' => ['required','exists:users,id']
        ]); 
        $event = new Event;
        $event->name = $request->name;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->venue_id = $request->venue_id;        
        $event->user_id = $request->user_id;
        $event->save();
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        Gate::authorize('view',$event);
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $response = Gate::inspect('update', $event);
        if($response->allowed())
        {
            $validateddata = $request->validate([
                'name' => ['required','unique:events'],
                'description' => ['required'],
                'date' => ['required','date'],
                'venue_id' => ['required'],
                'user_id' => ['required']
            ]); 
    
            $event->update($validateddata);
            return new EventResource($event);
        } else {
            return $response->message();
        }

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        Gate::authorize('delete',$event);
        $event->delete();
        return new EventResource($event);
    }
}
