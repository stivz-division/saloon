<?php

namespace App\Models;

use App\Domain\Enum\StockType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{

    protected $fillable
        = [
            'subscription_id',
            'description',
            'type',
            'percent',
            'price',
            'start_at',
            'end_at',
            'is_active',
        ];

    protected $casts
        = [
            'type' => StockType::class,
            'is_active' => 'boolean',
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'price' => 'float',
            'percent' => 'integer',
        ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $productPrice = $model->subscription->price;

            if ($model->type === StockType::Price) {
                $price = $model->price;

                $model->percent = round((($productPrice - $price) / $productPrice) * 100);
            }

            if ($model->type === StockType::Percent) {
                $discount = $productPrice * ($model->percent / 100);

                $model->price = $productPrice - $discount;
            }
        });
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

}
