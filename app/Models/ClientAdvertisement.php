<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class ClientAdvertisement extends Model
{

    use Searchable;

    public const FACETS
        = [
            'yandex_location_id',
            'pet_id',
            'animal',
            'breed_id',
        ];

    public const FILTERED_ATTRIBUTES
        = [
            'id',
            'user_id',
            'pet_id',
            'yandex_location_id',
            'is_payment',
            'is_published',
            'animal',
            'breed_id',
            'datetime_service_at',
        ];

    public const SORTABLE_ATTRIBUTES
        = [
            'id',
            'user_id',
            'pet_id',
            'yandex_location_id',
            'description',
            'datetime_service_at',
            'is_payment',
            'is_published',
            'published_at',
            'published_end_at',
            'created_at',
        ];

    protected $fillable
        = [
            'user_id',
            'pet_id',
            'yandex_location_id',
            'description',
            'datetime_service_at',
            'is_payment',
            'is_published',
            'published_at',
            'published_end_at',
        ];

    protected $casts
        = [
            'datetime_service_at' => 'datetime',
            'is_payment'          => 'boolean',
            'is_published'        => 'boolean',
            'published_at'        => 'datetime',
            'published_end_at'    => 'datetime',
        ];

    public function toSearchableArray()
    {
        return [
            'id'                  => $this->id,
            'user_id'             => $this->user_id,
            'pet_id'              => $this->pet_id,
            'animal'              => $this->pet->animal->title,
            'breed_id'            => $this->pet->breed_id,
            'yandex_location_id'  => $this->yandex_location_id,
            'description'         => $this->description,
            'datetime_service_at' => Carbon::parse($this->datetime_service_at)->timestamp,
            'is_payment'          => $this->is_payment,
            'is_published'        => $this->is_published,
            'published_at'        => $this->published_at,
            'published_end_at'    => $this->published_end_at,
            'created_at'          => $this->created_at,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function yandexLocation(): BelongsTo
    {
        return $this->belongsTo(YandexLocation::class);
    }

    public function isAuthor(int $userId): bool
    {
        return $this->user_id === $userId;
    }

    public function clientAdvertisementMasters(): HasMany
    {
        return $this->hasMany(ClientAdvertisementMaster::class);
    }

    public function itMasterPayment(int $masterId): bool
    {
        return $this
            ->clientAdvertisementMasters
            ->pluck('user_id')
            ->contains($masterId);
    }

}
