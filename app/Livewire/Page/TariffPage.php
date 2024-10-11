<?php

namespace App\Livewire\Page;

use App\Repositories\SubscriptionRepository;
use Livewire\Component;

class TariffPage extends Component
{

    public function render()
    {
        $tariffs = app(SubscriptionRepository::class)->list();

        return view('livewire.page.tariff-page', compact('tariffs'));
    }

}
