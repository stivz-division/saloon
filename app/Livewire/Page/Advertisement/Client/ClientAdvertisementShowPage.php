<?php

namespace App\Livewire\Page\Advertisement\Client;

use App\Repositories\ClientAdvertisementRepository;
use Livewire\Component;

class ClientAdvertisementShowPage extends Component
{

    /** @var \App\Models\ClientAdvertisement */
    public $advertisement;

    public function mount($advertisement)
    {
        $clientAdvertisementRepository
            = app(ClientAdvertisementRepository::class);

        $this->advertisement
            = $clientAdvertisementRepository->getByUuid($advertisement);
    }

    public function render()
    {
        return view('livewire.page.advertisement.client.client-advertisement-show-page');
    }

}
