<div class="card mb-4 rounded-3 shadow-sm position-relative">
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">
            {{ $item->name }}
        </h4>
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">
            {{$item->price}}₽
        </h1>

        <ul class="list-unstyled mt-3 mb-4">
            @if($item->views_count !== null)
                <li>Объявлений: {{ $item->views_count }} шт.</li>
            @endif

            @if($item->views_count === null)
                <li>По времени: {{ $item->viewing_days }} дней</li>
            @endif
        </ul>
        @if($buy)
            <button
                    wire:click="paymentAdvertisement({{ $item->id }})"
                    type="button"
                    class="w-100 btn btn-lg btn-primary"
            >
                Оформить
            </button>
        @endif
    </div>
</div>
