<div>
    <h5>Желаемая дата услуги</h5>
    <div class="mb-2">
        <label
                class="form-label"
                for="datetime_start"
        >От</label>
        <input
                wire:model.live="start"
                type="datetime-local"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="datetime_start"
                aria-describedby="Желаемая дата получения услуги от"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"
                required
        >
    </div>
    <div>
        <label
                class="form-label"
                for="datetime_end"
        >До</label>
        <input
                wire:model.live="end"
                type="datetime-local"
                class="form-control"
                min="{{ now()->toDateString() }}"
                id="datetime_end"
                aria-describedby="Желаемая дата получения услуги до"
                pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"
                required
        >
    </div>
</div>
