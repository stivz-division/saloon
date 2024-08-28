<div>
    @if($breedObjects->count())
        <ul class="list-group">
            @foreach($breedObjects as $breedObject)
                <li class="list-group-item">
                    <input
                            wire:model.live="selectBreeds"
                            class="form-check-input me-1"
                            type="checkbox"
                            value="{{ $breedObject->id }}"
                            id="location_{{ $breedObject->id }}"
                    >
                    <label
                            class="form-check-label"
                            for="location_{{ $breedObject->id }}"
                    >
                        {{ $breedObject->name }} ( {{ $breedObject->count }} )
                    </label>
                </li>
            @endforeach
        </ul>
    @endif

</div>
