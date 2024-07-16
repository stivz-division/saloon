<div class="p-3 rounded-4 bg-light mb-3">
    <h2>Фотографии</h2>
    <div class="mb-3">
        <label
                for="file"
                class="form-label"
        >Вы можете загрузить фото или видео</label>
        <input
                wire:model="photos"
                class="form-control"
                accept="image/*"
                name="file"
                type="file"
                id="file"
                multiple
        >
    </div>

    @foreach($photos as $photo)
        <img
                height="190"
                width="190"
                src="/storage/livewire-tmp/{{ $photo->getFilename() }}"
                alt="{{ __("Фото") }}"
        >
    @endforeach
</div>