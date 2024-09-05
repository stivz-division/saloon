<?php

namespace App\Livewire\Page\Advertisement\Client\Facet;

use Livewire\Component;

class DateTimeService extends Component
{

    public $start;

    public $end;

    public function updatedStart()
    {
        $this->dispatch('change-datetime-service-start',
            datetime: $this->start);
    }

    public function updatedEnd()
    {
        $this->dispatch('change-datetime-service-end',
            datetime: $this->end);
    }

    public function render()
    {
        return view('livewire.page.advertisement.client.facet.date-time-service');
    }

}
