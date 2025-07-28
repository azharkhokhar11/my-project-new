<?php

namespace App\Repositories;

use App\Models\Speaker;

class SpeakerRepository implements SpeakerRepositoryInterface
{
    public function all()
    {
        return Speaker::with('events')->latest()->get();
    }

    public function find(int $id): Speaker
    {
        return Speaker::with('events')->findOrFail($id);
    }

    public function create(array $data, array $events = []): Speaker
    {
        $speaker = Speaker::create($data);
        $speaker->events()->sync($events);
        return $speaker;
    }

    public function update(Speaker $speaker, array $data, array $events = []): Speaker
    {
        $speaker->update($data);
        $speaker->events()->sync($events);
        return $speaker;
    }

    public function delete(Speaker $speaker): void
    {
        $speaker->delete();
    }
}
