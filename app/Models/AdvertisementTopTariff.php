<?php

namespace App\Models;

use App\Casts\TimeCast;
use App\Domain\Enum\AdvertisementTopTariffsType;
use Illuminate\Database\Eloquent\Model;

class AdvertisementTopTariff extends Model
{

    protected $fillable
        = [
            'name',
            'count_days',
            'type',
            'start_time',
            'minutes',
            'status',
        ];

    protected $casts
        = [
            'status'     => 'boolean',
            'type'       => AdvertisementTopTariffsType::class,
            'start_time' => TimeCast::class,
        ];

}
