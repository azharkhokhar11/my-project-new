<?php

namespace App\Repositories;

use App\Models\Event;

interface EventRepositoryInterface
{
    public function all();
    public function create(array $data): Event;
    public function find(Event $event): Event;
    public function update(Event $event, array $data): Event;
    public function delete(Event $event): bool;
}

