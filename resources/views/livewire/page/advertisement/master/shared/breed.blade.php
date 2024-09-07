<div class="mb-3 card-body card">

    <h3>Порода</h3>

    <livewire:components.multi-select
            :service="$serviceBreed"
            @change-selected="setBreeds($event.detail.selected)"
            :set="$breeds"
            :max="$max ?? null"
            :data="['animal_id' => $dogAnimal->id]"
            placeholder="Укажите породу"
    />

    <span class="text-muted small">Например: овчарка</span>
</div>
