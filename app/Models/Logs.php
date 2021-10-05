<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Logs extends Model
{
    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'ip',
        'url',
        'user_agent',
    ];
}
