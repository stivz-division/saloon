<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable
        = [
            'name',
            'advertisement_count',
            'published_days',
            'price',
            'status',
        ];

    protected $casts
        = [
            'price'  => 'float',
            'status' => 'boolean',
        ];

}
