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
