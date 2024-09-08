<?php

namespace App\Livewire\Page\Advertisement\Client;

use App\Domain\DTO\ClientAdvertisementStoreData;
use App\Livewire\Components\Hepler\MultiSelect\Location;
use App\Repositories\ClientAdvertisementRepository;
use App\Repositories\PetRepository;
use App\Rules\Client\ClientAdvertisementDateTimeRule;
use App\Services\ClientAdvertisementService;
use Carbon\Carbon;
use Livewire\Component;

class ClientAdvertisementPage extends Component
{

    use Location;

    /** @var \App\Models\User */
    public $user;

    public $description;

    public $pet;

    public $userPets;

    public $datetime;

    public $format = 'Y-m-d\TH:i';

    public function mount()
    {
        $this->user     = auth()->user();
        $this->userPets = $this->user->pets;

        $link = request()->get('link');

        if ($link !== null) {
            $clientAdvertisement
                = app(ClientAdvertisementRepository::class)->getById($link);

            $this->pet         = $clientAdvertisement->pet_id;
            $this->description = $clientAdvertisement->description;

            $this->locations = [
                [
                    'value' => $clientAdvertisement->yandexLocation->id,
                    'name'  => $clientAdvertisement->yandexLocation->location,
                ],
            ];

            $this->datetime
                = $clientAdvertisement->datetime_service_at?->toDateTimeString();
        }
    }

    public function rules()
    {
        return [
            'description'       => ['required', 'string', 'max:5000'],
            'pet'               => ['required', 'exists:pets,id'],
            'locations'         => ['required', 'array'],
            'locations.*.value' => ['required', 'exists:yandex_locations,id'],
            'datetime'          => [
                'required',
                'date_format:Y-m-d\TH:i',
                new ClientAdvertisementDateTimeRule(),
            ],
        ];
    }

    public function saveClientAdvertisement()
    {
        $this->validate();

        $clientAdvertisementService = app(ClientAdvertisementService::class);

        $clientAdvertisement = $clientAdvertisementService->store(
            new ClientAdvertisementStoreData(
                user_id: $this->user->id,
                pet_id: $this->pet,
                description: $this->description,
                yandex_location_id: count($this->locations)
                    ? $this->locations[0]['value'] : null,
                datetime_service_at: $this->datetime !== null
                    ? Carbon::createFromFormat($this->format, $this->datetime)
                    : null,
                is_published: true,
                published_at: now(),
                published_end_at: now()->clone()->addHours(3),
            )
        );

        $this->redirectRoute('client.advertisement.show', [
            'advertisement' => $clientAdvertisement->uuid,
        ]);
    }

    public function render()
    {
        if ($this->userPets->count() > 0) {
            $petObject = null;

            if ($this->pet !== null) {
                $petRepository = app(PetRepository::class);

                $petObject = $petRepository->getById($this->pet);
            }

            return view('livewire.page.advertisement.client.client-advertisement-page',
                compact('petObject'));
        } else {
            return view('livewire.page.advertisement.client.no-client-advertisement-page');
        }
    }

}
