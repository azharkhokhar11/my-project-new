<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use Psy\Readline\Hoa\EventSource;
use Illuminate\Support\Facades\Gate;
use App\Services\EventService;
use Illuminate\Validation\Rule;
use App\Traits\HasCacheTrait;
use Illuminate\Cache\HasCacheLock;

class EventsController extends Controller
{
    use HasCacheTrait;

    protected $service;

    public function __construct(EventService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Event::class);

        $events = $this->getFromCache('events.all', function(){
            return $this->service->getAll();
        });

        // $events = Event::with('venue:id,name','participants')->get();
        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        Gate::authorize('create', Event::class);
        $validateddata = $request->validated();

        $event = $this->service->create($validateddata);

        return new EventResource($event);

        // $event = new Event;
        // $event->name = $validateddata['name'];
        // $event->description = $validateddata['description'];
        // $event->date = $validateddata['date'];
        // $event->venue_id = $validateddata['venue_id'];        
        // $event->user_id = $validateddata['user_id'];
        // $event->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        Gate::authorize('view',$event);
        return new EventResource($this->service->show($event));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
        $response = Gate::inspect('update', $event);
        if($response->allowed())
        {
            $validateddata = $request->validated(); 

            $event = $this->service->update($event, $validateddata);
    
            // $event->update($validateddata);

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

        $this->service->delete($event);
        // $event->delete();

        return new EventResource($event);
    }
}
