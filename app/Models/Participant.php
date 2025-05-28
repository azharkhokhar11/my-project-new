<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /** @use HasFactory<\Database\Factories\ParticipantsFactory> */
    use HasFactory;

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

}
