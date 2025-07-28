<?php

namespace App\Services;

use App\Models\Speaker;
use App\Repositories\SpeakerRepositoryInterface;
use App\Events\EventCreated;

class SpeakerService
{
    protected SpeakerRepositoryInterface $repository;

    public function __construct(SpeakerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

      public function getAll()
    {
        return $this->repository->all();
    }

    public function getById(int $id): Speaker
    {
        return $this->repository->find($id);
    }

    public function create(array $data, array $events): Speaker
    {
        $speaker = $this->repository->create($data, $events);
        EventCreated::dispatch($speaker);
        return $speaker;
    }

    public function update(Speaker $speaker, array $data, array $events): Speaker
    {
        return $this->repository->update($speaker, $data, $events);
    }

    public function delete(Speaker $speaker): void
    {
        $this->repository->delete($speaker);
    }
}
