<?php

namespace App\Models;

use App\Events\EventCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /** @use HasFactory<\Database\Factories\ParticipantsFactory> */
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => EventCreated::class,
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
