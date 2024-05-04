<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class InfoMaster extends Model implements HasMedia
{

    use InteractsWithMedia;

    const MEDIA_COLLECTION_NAME = 'examples-works';

    protected $fillable
        = [
            'is_veterinarian',
            'is_delivering_pet',
            'is_home_check_out',
            'is_at_home',
        ];

    protected $casts
        = [
            'is_veterinarian'   => 'bool',
            'is_delivering_pet' => 'bool',
            'is_home_check_out' => 'bool',
            'is_at_home'        => 'bool',
        ];

}
