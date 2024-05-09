<?php

namespace App\Models;

use App\Domain\Enum\PetWeightType;
use Illuminate\Database\Eloquent\Model;

class PetWeight extends Model
{

    protected $fillable
        = [
            'title',
        ];

    protected $casts
        = [
            'title' => PetWeightType::class,
        ];

}
