<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepositoryInterface;

class EventService
{
     protected $repository;

    public function __construct(EventRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

       public function getAll()
    {
        return $this->repository->all();
    }

    public function create(array $data): Event
    {
        return $this->repository->create($data);
    }

    public function show(Event $event): Event
    {
        return $this->repository->find($event);
    }

    public function update(Event $event, array $data): Event
    {
        return $this->repository->update($event, $data);
    }

    public function delete(Event $event): bool
    {
        return $this->repository->delete($event);
    }
}
