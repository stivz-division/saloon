<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pet extends Model implements HasMedia
{

    use InteractsWithMedia;

    const MEDIA_COLLECTION_NAME = 'my-pets';

    protected $fillable
        = [
            'user_id',
            'breed_id',
            'animal_id',
            'pet_weight_id',
            'nickname',
        ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function petWeight(): BelongsTo
    {
        return $this->belongsTo(PetWeight::class, 'pet_weight_id', 'id');
    }

    public function image()
    {
        return $this->getMedia(self::MEDIA_COLLECTION_NAME)?->first();
    }

}
