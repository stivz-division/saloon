<?php

namespace App\Observers;

use App\Models\ClientAdvertisement;
use Ramsey\Uuid\Uuid;

class ClientAdvertisementObserver
{

    public function creating(ClientAdvertisement $clientAdvertisement): void
    {
        $clientAdvertisement->uuid = Uuid::uuid4();
    }

}
