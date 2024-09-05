<?php

namespace App\Livewire\Page\Advertisement\Client;

use App\Domain\DTO\ClientAdvertisementFilterData;
use App\Repositories\ClientAdvertisementRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class ClientAdvertisementListPage extends Component
{

    use WithPagination;

    public $search = '';

    public $locations = [];

    public $animals = [];

    public $breeds = [];

    public $dateTimeServiceStart;

    public $dateTimeServiceEnd;

    public $withoutDateTime = false;

    public function selectLocations($locations)
    {
        $this->setPage(1);

        $this->locations = $locations;
    }

    public function setDateTimeServiceStart($start)
    {
        $this->setPage(1);

        $this->dateTimeServiceStart = $start;
    }

    public function setDateTimeServiceEnd($end)
    {
        $this->setPage(1);

        $this->dateTimeServiceEnd = $end;
    }

    public function setWithoutDateTimeService($without)
    {
        $this->setPage(1);

        $this->withoutDateTime = $without;
    }

    public function selectAnimals($animals)
    {
        $this->setPage(1);

        $this->animals = $animals;
    }

    public function selectBreeds($breeds)
    {
        $this->setPage(1);

        $this->breeds = $breeds;
    }

    public function render()
    {
        $clientAdvertisementRepository
            = app(ClientAdvertisementRepository::class);

        $advertisementsRaw
            = $clientAdvertisementRepository->searchAdvertisementsForCatalog(
            $this->search,
            new ClientAdvertisementFilterData(
                $this->locations,
                $this->animals,
                $this->breeds,
                $this->withoutDateTime,
                $this->dateTimeServiceStart
                    ? Carbon::parse($this->dateTimeServiceStart) : null,
                $this->dateTimeServiceEnd
                    ? Carbon::parse($this->dateTimeServiceEnd) : null,
            ),
            4
        );

        $facetDistribution = $advertisementsRaw->items()['facetDistribution'];

        $idAdvertisements = Arr::pluck($advertisementsRaw->items()['hits'],
            'id');

        return view('livewire.page.advertisement.client.client-advertisement-list-page',
            [
                'advertisements'    => $clientAdvertisementRepository->getByIds($idAdvertisements),
                'paginator'         => $advertisementsRaw,
                'facetDistribution' => $facetDistribution,
            ]);
    }

}
