<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }

    public function getFinalPrice()
    {
        $price = $this->price;

        if ($this->stock !== null && $this->stock->start_at->isPast()) {
            $price = $this->stock->price;
        }

        return $price;
    }

}
