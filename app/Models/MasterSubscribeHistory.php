<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterSubscribeHistory extends Model
{

    protected $fillable
        = [
            'user_id',
            'price',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
