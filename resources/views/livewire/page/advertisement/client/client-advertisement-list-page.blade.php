<div>
    <h1>Заявки</h1>

    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Заявки</h2>

        <div class="mb-3">
            <label for="search" class="form-label">Поиск</label>
            <input
                wire:model.live="search"
                type="search"
                class="form-control"
                name="search"
                id="search"
                placeholder="Поиск..."
            >
        </div>

        @if(isset($facetDistribution['yandex_location_id']))
            <div>
                <livewire:page.advertisement.client.facet.client-advertisement-location
                    @change-locations="selectLocations($event.detail.selected)"
                    :select-locations="$locations"
                    wire:key="{{ implode(',', $facetDistribution['yandex_location_id']) }}"
                    :locations="$facetDistribution['yandex_location_id']"/>
            </div>
        @endif

    </div>

    @if($advertisements->count())
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
                            <a class="btn btn-primary" href="{{ route('client.advertisement.show', [
                                'advertisement' => $advertisement->uuid
                            ]) }}">Подробнее</a>
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
