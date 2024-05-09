<?php

namespace App\Livewire\Page\Advertisement\Client;

use App\Domain\DTO\ClientAdvertisementFilterData;
use App\Repositories\ClientAdvertisementRepository;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class ClientAdvertisementListPage extends Component
{

    use WithPagination;

    public $search = '';

    public $locations = [];

    public function selectLocations($locations)
    {
        $this->setPage(1);
        
        $this->locations = $locations;
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
