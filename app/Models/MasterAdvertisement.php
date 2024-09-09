<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class MasterAdvertisement extends Model implements HasMedia
{

    use Searchable;
    use InteractsWithMedia;

    const MEDIA_COLLECTION_NAME = 'master-advertisement';

    public const FACETS
        = [
            'animals',
            'breeds',
            'locations',
            'pet_weights',
        ];

    public const FILTERED_ATTRIBUTES
        = [
            'user_id',
            'is_published',
            'animals',
            'breeds',
            'locations',
            'pet_weights',
            'start_at',
            'end_at',
        ];

    public const SORTABLE_ATTRIBUTES
        = [
            'id',
            'price',
            'user_id',
            'title',
            'start_at',
            'end_at',
            'published_at',
            'end_published_at',
            'created_at',
            'top_at',
        ];

    protected $fillable
        = [
            'user_id',
            'title',
            'start_at',
            'end_at',
            'description',
            'advertisement_top_tariff_id',
            'set_top_tariff_at',
            'top_at',
            'price',
            'is_published',
            'published_at',
            'end_published_at',
        ];

    protected $casts
        = [
            'start_at'          => 'date',
            'end_at'            => 'date',
            'price'             => 'float',
            'is_published'      => 'bool',
            'published_at'      => 'datetime',
            'end_published_at'  => 'datetime',
            'set_top_tariff_at' => 'datetime',
            'top_at'            => 'datetime',
        ];

    public function toSearchableArray()
    {
        return [
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'title'            => $this->title,
            'start_at'         => $this->start_at?->timestamp,
            'end_at'           => $this->end_at?->timestamp,
            'published_at'     => $this->published_at,
            'end_published_at' => $this->end_published_at,
            'created_at'       => $this->created_at,
            'animals'          => $this->animals->pluck('id')->toArray(),
            'breeds'           => $this->breeds->pluck('id')->toArray(),
            'locations'        => $this->locations->pluck('id')->toArray(),
            'pet_weights'      => $this->petWeights->pluck('id')->toArray(),
            'is_published'     => $this->is_published,

        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advertisementTopTariff(): BelongsTo
    {
        return $this->belongsTo(AdvertisementTopTariff::class);
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(YandexLocation::class,
            'master_advertisement_locations');
    }

    public function animals(): BelongsToMany
    {
        return $this->belongsToMany(Animal::class,
            'master_advertisement_animals');
    }

    public function petWeights(): BelongsToMany
    {
        return $this->belongsToMany(PetWeight::class,
            'master_advertisement_pet_weights');
    }

    public function breeds(): BelongsToMany
    {
        return $this->belongsToMany(Breed::class,
            'master_advertisement_breeds');
    }

    public function images(): MediaCollection
    {
        return $this->getMedia(self::MEDIA_COLLECTION_NAME);
    }

    public function scopeActive(Builder $query): void
    {
        $query->where('is_published', true);
    }

}
