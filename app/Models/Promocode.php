<?php

namespace App\Models;

use App\Domain\Enum\PromocodeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promocode extends Model
{

    protected $fillable
        = [
            'type',
            'code',
            'is_active',
            'is_used',
            'used_at',
            'user_id',
        ];

    protected $casts
        = [
            'type'      => PromocodeType::class,
            'is_active' => 'boolean',
            'is_used'   => 'boolean',
            'used_at'   => 'datetime',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
