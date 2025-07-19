<?php

namespace App\Repositories;

use App\Models\Participant;

class ParticipantRepository implements ParticipantRepositoryInterface
{
    public function all()
    {
        return Participant::with('events.venue')->latest()->get();
    }

    public function find(int $id): Participant
    {
        return Participant::with('events.venue')->findOrFail($id);
    }

    public function create(array $data, array $events = []): Participant
    {
        $participant = Participant::create($data);
        $participant->events()->sync($events);
        return $participant;
    }

    public function update(Participant $participant, array $data, array $events = []): Participant
    {
        $participant->update($data);
        $participant->events()->sync($events);
        return $participant;
    }

    public function delete(Participant $participant): void
    {
        $participant->delete();
    }
}
