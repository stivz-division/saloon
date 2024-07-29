<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\User;
use App\Repositories\MasterAdvertisementRepository;
use Livewire\Component;
use Livewire\WithPagination;

class MyAdvertisements extends Component
{

    use WithPagination;

    public User $user;

    public function deleteAdvertisement(int $id)
    {
        $repository = app(MasterAdvertisementRepository::class);

        $advertisement = $repository->getById($id);
        $canDelete     = auth()->user()->can('delete', $advertisement);

        if ($canDelete && $advertisement !== null) {
            $advertisement->delete();

            $this->redirectRoute('profile');
        }
    }

    public function render()
    {
        $repository = app(MasterAdvertisementRepository::class);

        return view('livewire.page.profile.master.my-advertisements', [
            'advertisements' => $repository->getUserAdvertisementsPaginate(
                auth()->user(),
            ),
        ]);
    }

}
