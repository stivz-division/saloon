<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class ServiceMaster extends Model
{

    use SoftDeletes;
    use Searchable;

    protected $fillable
        = [
            'user_id',
            'title',
            'description',
            'price',
        ];

    public function toSearchableArray()
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
        ];
    }

    public function searchableAs(): string
    {
        return 'services_masters_index';
    }

    public function master(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
