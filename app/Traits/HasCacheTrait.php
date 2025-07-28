<?php

namespace App\Traits;

use illuminate\Support\Facades\Cache;

trait HasCacheTrait
{
    public function getFromCache(string $key, \Closure $callback, int $ttl = 3600)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    public function forgetCache(string $key)
    {
        Cache::forget($key);
    }
}
