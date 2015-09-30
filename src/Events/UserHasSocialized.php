<?php


namespace Tshafer\Sociable\Events;

use App\Events\Event;
use Illuminate\Support\Collection;

class UserHasSocialized
{

    /** @var string */
    public $provider;

    /** @var array */
    public $profile;

    /** @var string */
    public $model;

    /** @var array */
    public $fields;

    /** @var array */
    public $additionalFields;

    /**
     * Create a new event instance.
     */
    public function __construct($provider, $profile, $model, $fields, $additionalFields)
    {
        $this->provider = $provider;
        $this->profile = new Collection($profile);
        $this->model = $model;
        $this->fields = new Collection($fields);
        $this->additionalFields = new Collection($additionalFields);
    }
}
