<?php

namespace Tshafer\Sociable\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = 'sociables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'provider',
      'token',
      'uid',
      'nickname',
      'name',
      'email',
      'avatar',
      'user',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['user' => 'array'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
