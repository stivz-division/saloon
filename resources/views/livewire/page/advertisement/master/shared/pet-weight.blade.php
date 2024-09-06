<div class="mb-3 card card-body">
    <h3

    >Вес</h3>

    <livewire:components.multi-select
            :service="$servicePetWeight"
            :empty="true"
            @change-selected="setPetWeights($event.detail.selected)"
            :set="$petWeights"
            placeholder="Укажите вес"
    />

    <span class="text-muted small">Например: до 6 кг</span>
</div>