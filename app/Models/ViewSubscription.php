<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewSubscription extends Model
{

    protected $fillable
        = [
            'name',
            'views_count',
            'viewing_days',
            'price',
            'status',
        ];

    protected $casts
        = [
            'price' => 'float',
            'status' => 'boolean',
        ];
}
