<?php

namespace App\Repositories;

use App\Models\Speaker;

interface SpeakerRepositoryInterface
{
    public function all();
    public function find(int $id): Speaker;
    public function create(array $data, array $events = []): Speaker;
    public function update(Speaker $speaker, array $data, array $events = []): Speaker;
    public function delete(Speaker $speaker): void;
}

