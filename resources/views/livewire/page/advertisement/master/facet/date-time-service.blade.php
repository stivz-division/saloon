<div>
    <h5>Желаемая дата услуги</h5>
    <div class="mb-2">
        <label
                class="form-label"
                for="datetime_start"
        >От</label>
        <input
                wire:model.live="start"
                type="date"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="datetime_start"
                aria-describedby="Желаемая дата получения услуги от"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                required
        >
    </div>
    <div class="mb-3">
        <label
                class="form-label"
                for="datetime_end"
        >До</label>
        <input
                wire:model.live="end"
                type="date"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="datetime_end"
                aria-describedby="Желаемая дата получения услуги до"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                required
        >
    </div>
</div>
