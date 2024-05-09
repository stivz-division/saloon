<?php

namespace App\Models;

use App\Domain\Enum\AnimalType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{

    protected $fillable
        = [
            'title',
        ];

    protected $casts
        = [
            'title' => AnimalType::class,
        ];

    public function breeds(): HasMany
    {
        return $this->hasMany(Breed::class);
    }

}
