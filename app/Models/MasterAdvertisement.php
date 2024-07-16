<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class MasterAdvertisement extends Model implements HasMedia
{

    use InteractsWithMedia;

    const MEDIA_COLLECTION_NAME = 'master-advertisement';

    protected $fillable
        = [
            'title',
            'start_at',
            'end_at',
            'description',
            'price',
            'status',
        ];

    protected $casts
        = [
            'start_at' => 'date',
            'end_at'   => 'date',
            'price'    => 'float',
            'status'   => 'bool',
        ];

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

}
