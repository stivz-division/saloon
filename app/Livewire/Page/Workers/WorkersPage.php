<?php

namespace App\Livewire\Page\Workers;

use App\Repositories\UserRepository;
use Livewire\Component;
use Livewire\WithPagination;

class WorkersPage extends Component
{

    use WithPagination;

    public function render()
    {
        $masters = app(UserRepository::class)
            ->getPaginateMasters();

        return view('livewire.page.workers.workers-page', compact('masters'));
    }

}
