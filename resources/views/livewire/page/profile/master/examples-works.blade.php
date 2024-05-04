<div>
    <h2>Примеры работ</h2>

    <x-alert.block/>

    @if($mediaItems->count())

        @php
            /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media $item */
        @endphp
        <div class="row row-cols-auto my-2 g-2">

            @foreach($mediaItems as $item)
                @if($item->getTypeFromMime() === 'image')
                    <div class="col position-relative">

                        <div wire:click.prevent="deleteMedia({{ $item->id }})" class="position-absolute"
                             style="top: 5px; right: 10px; cursor: pointer">
                            <i class="bi bi-trash-fill text-danger fs-4"></i>
                        </div>


                        <a href="{{ $item->getFullUrl() }}" target="_blank">
                            <img
                                    class="rounded-3"
                                    style="object-fit: cover; width: 154px; height: 154px"
                                    src="{{ $item->getFullUrl() }}"
                                    alt="{{ $item->name }}"
                            >
                        </a>
                    </div>
                @else
                    <div class="col position-relative">
                        <a href="{{ $item->getFullUrl() }}" target="_blank">
                            <div class="bg-light rounded-3 border d-flex justify-content-center align-items-center"
                                 style="width: 154px; height: 154px">

                                <div wire:click.prevent="deleteMedia({{ $item->id }})" class="position-absolute"
                                     style="top: 5px; right: 10px; cursor: pointer">
                                    <i class="bi bi-trash-fill text-danger fs-4"></i>
                                </div>

                                <i class="bi bi-camera-reels-fill fs-4 text-muted"></i>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>

    @endif

    <form wire:submit.prevent="uploadFile">
        <div class="mb-3">
            <label for="file" class="form-label">Вы можете загрузить фото или видео</label>
            <input wire:model="file" class="form-control" accept="image/*,video/*" name="file" type="file" id="file"
                   required>
        </div>

        @if($file !== null)
            <input class="btn btn-primary" type="submit" value="Сохранить">
        @endif

    </form>

</div>
