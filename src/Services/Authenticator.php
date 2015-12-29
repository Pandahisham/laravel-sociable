<?php

namespace Tshafer\Sociable\Services;

use Tshafer\Sociable\Events\UserHasSocialized;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Contracts\Factory as Socialite;

class Authenticator
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Socialite
     */
    private $socialite;

    /** @var string */
    public $event = UserHasSocialized::class;

    /** @var string */
    public $provider;

    /** @var string */
    public $model;

    /** @var array */
    public $fields;

    /** @var array */
    public $additionalFields;

    /**
     * @param Socialite $socialite
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    /**
     * @param bool $hasCode
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function execute($hasCode)
    {
        if (!$hasCode) {
            return $this->getAuthorizationFirst();
        }

        $event = new $this->event(
          $this->provider, $this->getUser(),
          $this->model, $this->fields, $this->additionalFields
        );

        return Event::fire($event);
    }

    /**
     * @param string $value
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    public function provider($value)
    {
        $this->provider = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    public function model($value)
    {
        $this->model = $value;

        return $this;
    }

    /**
     * @param string $key
     * @param string $value
     * @param bool   $additional
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    public function mapField($key, $value, $additional = false)
    {
        if ($additional) {
            $this->additionalFields[$key] = $value;
        } else {
            $this->fields[$key] = $value;
        }

        return $this;
    }

    /**
     * @param string $value
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    public function event($value)
    {
        $this->event = $value;

        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst()
    {
        return $this->socialite->driver($this->provider)->redirect();
    }

    /**
     * @return \Laravel\Socialite\Contracts\User
     */
    private function getUser()
    {
        return $this->socialite->driver($this->provider)->user();
    }
}
