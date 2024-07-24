<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementFilterData;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Repositories\MasterAdvertisementRepository;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class MasterAdvertisementListPage extends Component
{

    use WithPagination;
    use Location;

    public $search = '';

    public function selectLocations($locations)
    {
        $this->setPage(1);

        $this->locations = $locations;
    }

    public function render()
    {
        $masterAdvertisementRepository
            = app(MasterAdvertisementRepository::class);

        $advertisementsRaw
            = $masterAdvertisementRepository->searchAdvertisementsForCatalog(
            $this->search,
            new MasterAdvertisementFilterData(
                $this->locations,
            ),
            4
        );

        $facetDistribution = $advertisementsRaw->items()['facetDistribution'];

        $idAdvertisements = Arr::pluck($advertisementsRaw->items()['hits'],
            'id');

        return view('livewire.page.advertisement.master.master-advertisement-list-page',
            [
                'advertisements'    => $masterAdvertisementRepository->getByIds($idAdvertisements),
                'paginator'         => $advertisementsRaw,
                'facetDistribution' => $facetDistribution,
            ]);
    }

}
