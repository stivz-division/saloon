<div class="p-3 rounded-4 bg-light mb-3">
    <h2>Период услуги</h2>
    <div @class(['mb-3'])>
        @error('start_at')
        <div class="alert alert-danger my-2">{{ $message }}</div>
        @enderror

        <label for="start_at">
            Период услуги от
        </label>

        <input
                wire:model="start_at"
                type="date"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="start_at"
                aria-describedby="Желаемая дата получения услуги"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
        >
    </div>

    <div>
        @error('end_at')
        <div class="alert alert-danger my-2">{{ $message }}</div>
        @enderror

        <label for="end_at">
            Период услуги до
        </label>

        <input
                wire:model="end_at"
                type="date"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="end_at"
                aria-describedby="Желаемая дата получения услуги"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
        >
    </div>
</div>