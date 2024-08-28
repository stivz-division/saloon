<?php

namespace App\Livewire\Page\Advertisement\Client\Facet;

use App\Models\YandexLocation;
use App\Repositories\YandexLocationRepository;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ClientAdvertisementLocation extends Component
{

    public $locations = [];

    public $locationObjects;

    public $selectLocations = [];

    public function updatedselectLocations()
    {
        $this->dispatch('change-locations', selected: $this->selectLocations);
    }

    public function render()
    {
        $yandexLocationRepository = app(YandexLocationRepository::class);

        $idLocations = DB::table('client_advertisements')
            ->distinct()
            ->select('yandex_location_id')
            ->pluck('yandex_location_id')
            ->toArray();

        $this->locationObjects = $yandexLocationRepository->getByIds(
            $idLocations,
        )->map(function (YandexLocation $location) {
            if (isset($this->locations[$location->id])) {
                $location->count = $this->locations[$location->id];
            } else {
                $location->count = 0;
            }

            return $location;
        });

        return view('livewire.page.advertisement.client.facet.client-advertisement-location');
    }

}
