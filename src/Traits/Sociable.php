<?php

namespace Tshafer\Sociable\Traits;

use Tshafer\Sociable\Models\Provider;

trait Sociable
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function sociables()
    {
        return $this->morphMany(Provider::class, 'model');
    }

    /**
     * @param string $provider
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSociable($provider)
    {
        return $this->sociables()->whereProvider($provider)->firstOrFail();
    }
}
