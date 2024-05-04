<?php

namespace App\Livewire\Page\Profile\Master;

use App\Models\InfoMaster;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExamplesWorks extends Component
{

    use WithFileUploads;

    public User $user;

    #[Validate('required|file|mimes:jpeg,png,mp4,mov,avi|max:5048')]
    public $file;

    public $mediaItems;

    public function mount()
    {
        $this->mediaItems = $this
            ->user
            ->infoMaster
            ->getMedia(
                InfoMaster::MEDIA_COLLECTION_NAME
            );
    }

    public function deleteMedia($mediaId)
    {
        $media = Media::query()->find($mediaId);

        $media->delete();

        session()->flash('success', 'Файл успешно удален.');

        $this->user->refresh();

        $this->mount();
    }

    public function uploadFile()
    {
        $this->validate();

        /** @var TemporaryUploadedFile $file */
        $file = $this->file;

        /** @var \App\Models\InfoMaster $infoMaster */
        $infoMaster = $this->user->infoMaster;

        $infoMaster->addMedia($file)
            ->toMediaCollection(InfoMaster::MEDIA_COLLECTION_NAME);

        $this->file = null;

        session()->flash('success', 'Файл успешно загружен.');

        $this->user->refresh();

        $this->mount();
    }

    public function render()
    {
        return view('livewire.page.profile.master.examples-works');
    }

}
