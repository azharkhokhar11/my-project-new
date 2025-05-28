<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /** @use HasFactory<\Database\Factories\VenueFactory> */
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone_number'];

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
