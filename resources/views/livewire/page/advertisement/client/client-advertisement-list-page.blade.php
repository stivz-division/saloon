<div>
    <h1>Объявления</h1>

    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Фильтрация</h2>

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

        @if(isset($facetDistribution['animal']))

            <livewire:page.advertisement.client.facet.animals
                @change-animals="selectAnimals($event.detail.selected)"
                :select-animals="$animals"
                wire:key="{{ uniqid('', true) }}"
                :animals="$facetDistribution['animal']"
            />

            <hr>

        @endif


        @if(isset($facetDistribution['breed_id']))

            <livewire:page.advertisement.client.facet.breeds
                @change-breeds="selectBreeds($event.detail.selected)"
                :select-breeds="$breeds"
                wire:key="{{ uniqid('', true) }}"
                :breeds="$facetDistribution['breed_id']"
            />

            <hr>

        @endif

        @if(isset($facetDistribution['yandex_location_id']))
            <div>
                <livewire:page.advertisement.client.facet.client-advertisement-location
                    @change-locations="selectLocations($event.detail.selected)"
                    :select-locations="$locations"
                    wire:key="{{ uniqid('', true) }}"
                    :locations="$facetDistribution['yandex_location_id']"
                />
            </div>

            <hr>
        @endif

        <div>
            <livewire:page.advertisement.client.facet.date-time-service
                @change-datetime-service-start="setDateTimeServiceStart($event.detail.datetime)"
                @change-datetime-service-end="setDateTimeServiceEnd($event.detail.datetime)"
                @change-without-datetime-service="setWithoutDateTimeService($event.detail.without)"
                :start="$dateTimeServiceStart"
                :end="$dateTimeServiceEnd"
                :without="$withoutDateTime"
                wire:key="{{ uniqid('', true) }}"
            />
        </div>

    </div>

    @if($animals || $breeds || $locations || $dateTimeServiceStart || $dateTimeServiceEnd || $withoutDateTime)
        <button class="btn btn-secondary mb-3" onclick="location.reload();">Сбросить фильтры</button>
    @endif

    @if($advertisements->count())
        <h3>Всего объявлений: {{ $paginator->total() }}</h3>
        <div class="row row-cols-1 row-cols-lg-4 mb-3 g-2">
            @foreach($advertisements as $advertisement)
                <div class="col">
                    <div class="border rounded-3 p-3 h-100">
                        @include('livewire.page.advertisement.client.shared.card', [
                            'advertisement' => $advertisement,
                            'published' => false,
                            'contacts' => false
                        ])

                        <div class="text-end">
                            <a
                                class="btn btn-primary"
                                href="{{ route('client.advertisement.show', [
                                'advertisement' => $advertisement->uuid
                            ]) }}"
                            >Подробнее</a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{ $paginator->links() }}
    @else
        <h2>Пока нет заявок</h2>
    @endif


</div>
