<div>
    @if($locationObjects->count())
        <ul class="list-group">
            @foreach($locationObjects as $locationObject)
                <li class="list-group-item">
                    <input
                            wire:model.live="selectLocations"
                            class="form-check-input me-1"
                            type="checkbox"
                            value="{{ $locationObject->id }}"
                            id="location_{{ $locationObject->id }}"
                    >
                    <label
                            class="form-check-label"
                            for="location_{{ $locationObject->id }}"
                    >
                        {{ $locationObject->location }} ( {{ $locationObject->count }} )
                    </label>
                </li>
            @endforeach
        </ul>
    @endif

</div>
