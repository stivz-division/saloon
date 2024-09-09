<div>
    <h1>Услуги мастеров</h1>

    <div class="p-3 rounded-4 bg-light mb-3">
        <h1>Фильтрация</h1>

        <div class="mb-3">
            <label
                    for="search"
                    class="form-label"
            >Поиск</label>
            <input
                    wire:model.live="search"
                    type="search"
                    class="form-control"
                    name="search"
                    id="search"
                    placeholder="Поиск..."
            >
        </div>

        <hr>

        @if(isset($facetDistribution['animals']))

            <livewire:page.advertisement.client.facet.animals
                    @change-animals="selectAnimals($event.detail.selected)"
                    :select-animals="$facetAnimals"
                    wire:key="{{ uniqid('', true) }}"
                    :animals="$facetDistribution['animals']"
            />

            <hr>

        @endif

        @if(isset($facetDistribution['breeds']))

            <livewire:page.advertisement.master.facet.breeds
                    @change-breeds="selectBreeds($event.detail.selected)"
                    :select-breeds="$facetBreeds"
                    wire:key="{{ uniqid('', true) }}"
                    :breeds="$facetDistribution['breeds']"
            />

            <hr>

        @endif

        @if(isset($facetDistribution['locations']))
            <div>
                <livewire:page.advertisement.master.facet.locations
                        @change-locations="selectLocations($event.detail.selected)"
                        :select-locations="$facetLocations"
                        wire:key="{{ uniqid('', true) }}"
                        :locations="$facetDistribution['locations']"
                />
            </div>

            <hr>
        @endif

        <livewire:page.advertisement.master.facet.date-time-service
                @change-datetime-service-start="setDateTimeServiceStart($event.detail.datetime)"
                @change-datetime-service-end="setDateTimeServiceEnd($event.detail.datetime)"
                :start="$dateTimeServiceStart"
                :end="$dateTimeServiceEnd"
                wire:key="{{ uniqid('', true) }}"
        />
    </div>

    @if($advertisements->count())
        <div class="row row-cols-1 row-cols-lg-4 mb-3 g-2">
            @foreach($advertisements as $advertisement)
                <div class="col">
                    @include('livewire.page.advertisement.master.shared.card', [
                        'control' => false
                    ])
                </div>
            @endforeach
        </div>

        {{ $paginator->appends(['master' => request()->get('master')])->links() }}

    @else
        <h2>Пока нет услуг</h2>
    @endif
</div>
