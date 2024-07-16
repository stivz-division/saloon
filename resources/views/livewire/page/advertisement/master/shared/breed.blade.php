@if($animal && (int) $animal === $dogAnimal->id)
    <div class="mb-3">
        <label
                for="breed"
                class="form-label"
        >Порода</label>
        <select
                wire:model="breed"
                id="breed"
                class="form-select"
                aria-label="Выберите породу"
                required
        >
            <option
                    selected
                    value=""
            >Выберите породу
            </option>
            @foreach($breeds as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
@endif