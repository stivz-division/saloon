<?php

namespace App\Livewire\Components;

use App\Domain\Enum\PromocodeType;
use App\Services\PromocodeService;
use Livewire\Component;

class Promocode extends Component
{

    public $type;

    public $code;

    public function rules()
    {
        return [
            'code' => 'required|string|max:500',
        ];
    }

    public function activate()
    {
        $this->validate();

        $promocodeService = app(PromocodeService::class);

        try {
            $promocodeService->activate(
                auth()->user(),
                $this->code,
                PromocodeType::from($this->type)
            );

            $this->dispatch('activate');
        } catch (\Throwable $throwable) {
            return $this->addError('error', $throwable->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.promocode');
    }

}
