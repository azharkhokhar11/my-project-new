<?php

namespace App\Services;

use App\Models\Participant;
use App\Repositories\ParticipantRepositoryInterface;
use App\Events\EventCreated;

class ParticipantService
{
    protected ParticipantRepositoryInterface $repository;

    public function __construct(ParticipantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

      public function getAll()
    {
        return $this->repository->all();
    }

    public function getById(int $id): Participant
    {
        return $this->repository->find($id);
    }

    public function create(array $data, array $events): Participant
    {
        $participant = $this->repository->create($data, $events);
        EventCreated::dispatch($participant);
        return $participant;
    }

    public function update(Participant $participant, array $data, array $events): Participant
    {
        return $this->repository->update($participant, $data, $events);
    }

    public function delete(Participant $participant): void
    {
        $this->repository->delete($participant);
    }
}
