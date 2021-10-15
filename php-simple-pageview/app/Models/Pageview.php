<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pageview extends Model
{
    /**
     * Don't use create and modified timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uri', 'timestamp', 'referer_hash'
    ];
}
