<?php

namespace App\Models;

use App\Domain\Enum\AnimalType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Breed extends Model
{

    protected $fillable
        = [
            'name',
        ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class, 'animal_id');
    }

}
