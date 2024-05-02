<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class YandexLocation extends Model
{

    use Searchable;

    protected $fillable
        = [
            'lr',
            'location',
        ];

    public function toSearchableArray()
    {
        return [
            'id'       => (string) $this->id,
            'location' => $this->location,
        ];
    }

    public function searchableAs(): string
    {
        return 'yandex_locations';
    }

}
