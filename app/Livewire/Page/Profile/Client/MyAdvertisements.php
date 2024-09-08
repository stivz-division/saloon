<?php

namespace App\Livewire\Page\Profile\Client;

use App\Models\User;
use App\Repositories\ClientAdvertisementRepository;
use App\Services\ClientAdvertisementService;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class MyAdvertisements extends Component
{

    public const PUBLISHED_MODE = 'published';

    public const ARCHIVED_MODE = 'archived';

    use WithPagination;

    public User $user;

    public $mode = self::PUBLISHED_MODE;

    public function mount()
    {
        $this->mode = request()?->get('client_advertisements_mode',
            self::PUBLISHED_MODE);
    }

    public function changeMode(string $mode): void
    {
        $this->redirectRoute('profile', [
            'client_advertisements_mode' => $mode,
        ]);
    }

    public function deleteAdvertisement(int $id)
    {
        $repository = app(ClientAdvertisementRepository::class);

        $advertisement = $repository->getById($id);
        $canDelete     = auth()->user()->can('delete', $advertisement);

        if ($canDelete && $advertisement !== null) {
            $advertisement->delete();

            $this->redirectRoute('profile');
        }
    }

    public function archiveAdvertisement(int $id): void
    {
        $service = app(ClientAdvertisementService::class);

        $service->archiveById(
            auth()->user(),
            $id
        );

        $this->redirectRoute('profile');
    }

    public function publishAdvertisement(int $id): void
    {
        $service = app(ClientAdvertisementService::class);

        $service->publishById(
            auth()->user(),
            $id
        );

        $this->redirectRoute('profile');
    }

    #[Computed]
    public function countPublished(): int
    {
        return app(ClientAdvertisementRepository::class)->getUserPublishedAdvertisementsCount(
            auth()->user()
        );
    }

    #[Computed]
    public function countArchived(): int
    {
        return app(ClientAdvertisementRepository::class)->getUserArchivedAdvertisementsCount(
            auth()->user()
        );
    }

    public function render()
    {
        $repository = app(ClientAdvertisementRepository::class);

        $advertisements = collect();

        if ($this->mode === self::ARCHIVED_MODE) {
            $advertisements
                = $repository->getUserArchivedAdvertisementsPaginate(
                auth()->user(),
            );
        }

        if ($this->mode === self::PUBLISHED_MODE) {
            $advertisements
                = $repository->getUserPublishedAdvertisementsPaginate(
                auth()->user(),
            );
        }

        return view('livewire.page.profile.client.my-advertisements',
            compact('advertisements'));
    }

}
