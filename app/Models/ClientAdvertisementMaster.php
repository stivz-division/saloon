<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientAdvertisementMaster extends Model
{

    protected $fillable
        = [
            'user_id',
            'client_advertisement_id',
            'price',
        ];

}
