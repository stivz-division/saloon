<div class="mb-3">
    <label
            for="pet_weight"
            class="form-label"
    >Вес</label>
    <select
            wire:model="pet_weight"
            id="pet_weight"
            class="form-select"
            aria-label="Выберите вес"
            required
    >
        <option
                selected
                value=""
        >Выберите вес
        </option>
        @foreach($petWeights as $petWeight)
            <option value="{{ $petWeight->id }}">{{ $petWeight->title->name() }}</option>
        @endforeach
    </select>
</div>