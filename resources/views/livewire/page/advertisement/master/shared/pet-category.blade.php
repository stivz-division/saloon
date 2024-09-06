<div class="mb-3 card card-body">
    <h3>Категория</h3>
    <livewire:components.multi-select
            :service="$serviceAnimal"
            :empty="true"
            @change-selected="setAnimals($event.detail.selected)"
            :set="$animals"
            placeholder="Укажите категорию"
    />
</div>