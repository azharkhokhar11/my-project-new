<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
     public function all()
    {
        return Event::with('venue:id,name', 'participants')->get();
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function find(Event $event): Event
    {
        return $event;
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);
        return $event;
    }

    public function delete(Event $event): bool
    {
        return $event->delete();
    }
}
