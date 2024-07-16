<div class="p-3 rounded-4 bg-light mb-3">
    <h2 class="mb-0">Укажите где вы хотите получить услуги</h2>

    @error('locations')
    <div class="alert alert-danger my-2">{{ $message }}</div>
    @enderror

    <livewire:components.multi-select
            :service="$serviceLocation"
            @change-selected="setLocations($event.detail.selected)"
            max="1"
            :set="$locations"
            placeholder="Укажите места работы"
    />
</div>