<?php

namespace App\Models;

use App\Domain\Enum\AnimalType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $casts = [
        'title' => AnimalType::class
    ];
}
