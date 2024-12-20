<?php

namespace App\Livewire\Components;

use Livewire\Component;

class MultiSelect extends Component
{

    public $placeholder;

    public $empty = false;

    public $cleanAfterSelect = false;

    public $value;

    public $values;

    public $service;

    public $selected;

    public $max; // Максимальное клоичество элементов доступных к выбору

    public $set = [];

    public $data = [];

    public function mount()
    {
        $this->values   = collect();
        $this->selected = collect($this->set);

        if ($this->empty === true) {
            $this->updatedValue();
            $this->filterValues();
        }
    }

    public function updatedValue()
    {
        if ($this->empty === false && empty($this->value)) {
            $this->values = collect();

            return;
        }

        /** @var \App\Services\YandexLocationService $service */
        $service = app($this->service);

        $this->values = $service->searchForMultiSelect(
            search: $this->value,
            data: $this->data,
        );
    }

    private function filterValues()
    {
        $this->values = $this->values->filter(function ($item) {
            return ! in_array($item['value'],
                $this->selected->pluck('value')->toArray());
        });
    }

    public function deleteSelect($value)
    {
        $this->selected = $this->selected->filter(function ($item) use ($value
        ) {
            return $item['value'] !== $value;
        });

        $this->updatedValue();
        $this->filterValues();

        $this->dispatch('change-selected', selected: $this->selected);
    }

    public function selectItem($value, $name)
    {
        $this->selected->push(
            compact('value', 'name')
        );

        $this->filterValues();

        if ($this->cleanAfterSelect === true) {
            $this->value  = null;
            $this->values = collect();
        }

        $this->dispatch('change-selected', selected: $this->selected);
    }

    public function render()
    {
        return view('livewire.components.multi-select');
    }

}
