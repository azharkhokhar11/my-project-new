<?php

namespace App\Repositories;

use App\Models\Participant;

interface ParticipantRepositoryInterface
{
    public function all();
    public function find(int $id): Participant;
    public function create(array $data, array $events = []): Participant;
    public function update(Participant $participant, array $data, array $events = []): Participant;
    public function delete(Participant $participant): void;
}

