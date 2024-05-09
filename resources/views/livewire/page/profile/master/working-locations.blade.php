<div>
    <div class="card card-body">
        <x-alert.block/>
        <p>Укажите где вы оказываете свои услуги.</p>
        <div class="mb-2">
            <livewire:components.multi-select
                    :service="$serviceLocation"
                    @change-selected="setLocations($event.detail.selected)"
                    :set="$locations"
                    placeholder="Укажите места работы"
            />

        </div>

        <p>После внесения изменений обязательно нажмите на кнопку <strong>«Сохранить изменения»</strong>.</p>

        <div>
            <button type="button" wire:click="saveLocations" class="btn btn-primary d-inline-block">
                Сохранить изменения
            </button>
        </div>

    </div>
</div>
