<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InfoMaster extends Model implements HasMedia
{

    use InteractsWithMedia;

    const MEDIA_COLLECTION_NAME = 'examples-works';

    protected $fillable
        = [
            'view_subscription_id',
            'subscription_views',
            'is_veterinarian',
            'is_delivering_pet',
            'is_home_check_out',
            'is_at_home',
            'about',
            'breeds',
            'is_subscription',
            'subscription_at',
            'subscription_end_at',
        ];

    protected $casts
        = [
            'is_veterinarian'     => 'bool',
            'is_delivering_pet'   => 'bool',
            'is_home_check_out'   => 'bool',
            'is_at_home'          => 'bool',
            'is_subscription'     => 'bool',
            'subscription_at'     => 'datetime',
            'subscription_end_at' => 'datetime',
        ];

    public function canDopService(): bool
    {
        return $this->is_veterinarian
            || $this->is_delivering_pet
            || $this->is_home_check_out
            || $this->is_at_home;
    }

    public function viewSubscription(): BelongsTo
    {
        return $this->belongsTo(ViewSubscription::class);
    }

}
