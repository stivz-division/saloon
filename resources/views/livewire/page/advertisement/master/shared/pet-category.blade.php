<div class="mb-3">
    <label
            for="animal"
            class="form-label"
    >Категория</label>
    <select
            wire:model.live="animal"
            id="animal"
            class="form-select"
            aria-label="Выберите категорию"
            required
    >
        <option
                selected
                value=""
        >Выберите категорию
        </option>
        @foreach($animals as $item)
            <option value="{{ $item->id }}">{{ $item->title->name() }}</option>
        @endforeach
    </select>
</div>