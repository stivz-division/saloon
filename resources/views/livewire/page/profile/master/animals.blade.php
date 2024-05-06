<div>
    <h2>Работаю с</h2>

    <div class="card card-body">
        <x-alert.block/>
        <p>Укажите с какими питомцами работаете</p>
        <div class="mb-2">
            <livewire:components.multi-select
                :empty="true"
                :service="$service"
                @change-selected="setAnimals($event.detail.selected)"
                :set="$animals"
                placeholder="Укажите..."
            />

        </div>

        <p>После внесения изменений обязательно нажмите на кнопку <strong>«Сохранить изменения»</strong>.</p>

        <div>
            <button type="button" wire:click="saveAnimals" class="btn btn-primary d-inline-block">
                Сохранить изменения
            </button>
        </div>

    </div>
</div>
