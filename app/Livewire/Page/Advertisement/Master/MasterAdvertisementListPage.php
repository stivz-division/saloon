<?php

namespace App\Livewire\Page\Advertisement\Master;

use App\Domain\DTO\MasterAdvertisementFilterData;
use App\Models\Animal;
use App\Repositories\AnimalRepository;
use App\Repositories\MasterAdvertisementRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\WithPagination;

class MasterAdvertisementListPage extends Component
{

    use WithPagination;

    public $search = '';

    public $master;

    public $facetAnimals = [];

    public $facetBreeds = [];

    public $facetLocations = [];

    public $dateTimeServiceStart;

    public $dateTimeServiceEnd;

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

    public function mount()
    {
        if (request()->has('master')) {
            $this->master = app(UserRepository::class)->getUserByUuid(
                request()->get('master')
            );
        }
    }

    public function selectBreeds($breeds)
    {
        $this->setPage(1);

        $this->facetBreeds = $breeds;
    }

    public function selectLocations($locations)
    {
        $this->setPage(1);

        $this->facetLocations = $locations;
    }

    public function selectAnimals($animals)
    {
        $this->setPage(1);

        $this->facetAnimals = $animals;
    }

    public function render()
    {
        $masterAdvertisementRepository
            = app(MasterAdvertisementRepository::class);

        $advertisementsRaw
            = $masterAdvertisementRepository->searchAdvertisementsForCatalog(
            $this->search,
            new MasterAdvertisementFilterData(
                Animal::query()->where('title', $this->facetAnimals)
                    ->pluck('id')->toArray(),
                $this->facetBreeds,
                $this->facetLocations,
                $this->dateTimeServiceStart
                    ? Carbon::parse($this->dateTimeServiceStart)->setTime(0, 0)
                    : null,
                $this->dateTimeServiceEnd
                    ? Carbon::parse($this->dateTimeServiceEnd)->setTime(0, 0)
                    : null,
            ),
            masterId: $this->master?->id,
            perPage: 4
        );

        $facetDistribution = $advertisementsRaw->items()['facetDistribution'];

        $this->prepareFacetAnimal($facetDistribution);

        $idAdvertisements = Arr::pluck($advertisementsRaw->items()['hits'],
            'id');

        return view('livewire.page.advertisement.master.master-advertisement-list-page',
            [
                'advertisements'    => $masterAdvertisementRepository->getByIds($idAdvertisements),
                'paginator'         => $advertisementsRaw,
                'facetDistribution' => $facetDistribution,
            ]);
    }

    private function prepareFacetAnimal(array &$facetDistribution): void
    {
        if (isset($facetDistribution['animals'])) {
            $resultAnimalFacet = [];

            $animalRepository = app(AnimalRepository::class);

            foreach ($facetDistribution['animals'] as $key => $count) {
                $animal                                   = $animalRepository->getById($key);
                $resultAnimalFacet[$animal->title->value] = $count;
            }

            $facetDistribution['animals'] = $resultAnimalFacet;
        }
    }

}
