@php
    /** @var \Spatie\MediaLibrary\MediaCollections\Models\Media|null $image */
        $image = $pet->image();
@endphp

<div class="position-relative p-2 bg-secondary rounded-3 h-100"
     style="width: 206px"
>
    @if($delete)
        <div wire:click.prevent="deletePet({{ $pet->id }})"
             class="position-absolute"
             style="top: 10px; right: 15px; cursor: pointer">
            <div
                    class="bg-white d-flex justify-content-center align-items-center"
                    style="width: 30px; height: 30px; border-radius: 50%"
            >
                <i class="bi bi-trash-fill text-danger"></i>

            </div>
        </div>
    @endif


    <span class="badge text-bg-primary">
                                {{ $pet->animal->title->name() }}
                            </span>

    <div class="w-100 d-inline-block text-white fs-3">
        {{ $pet->nickname }}
    </div>

    @if($image !== null)
        <a href="{{ $image->getFullUrl() }}" target="_blank">
            <img
                    class="rounded-3"
                    style="width: 190px; height: 190px; object-fit: cover"
                    src="{{ $image->getFullUrl() }}"
                    alt="{{ $pet->nickname }}"
            >
        </a>
    @else
        <div
                class="bg-light rounded-3 border d-flex justify-content-center align-items-center"
                style="width: 190px; height: 190px"
        >
            <i class="bi bi-card-image me-0 fs-1"></i>
        </div>
    @endif

    @if($pet->breed)
        <div class="text-white small">
            {{ $pet->breed->name }}
        </div>
    @endif

    @if($pet->petWeight)
        <div class="text-white small">
            {{ $pet->petWeight->title->name() }}
        </div>
    @endif


</div>