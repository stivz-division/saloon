<div class="card mb-4 rounded-3 shadow-sm">
    <div class="card-header py-3">
        <h4 class="my-0 fw-normal">
            {{ $item->name }}
        </h4>
    </div>
    <div class="card-body">
        <h1 class="card-title pricing-card-title">
            {{$item->price}}₽<small class="text-body-secondary fw-light"></small>
        </h1>
        <ul class="list-unstyled mt-3 mb-4">
            <li>Объявлений: {{ $item->advertisement_count }} шт.</li>
            <li>Срок размещения: {{ $item->published_days }} дней</li>
            <li>Приоритетная поддержка по электронной почте</li>
            <li>Доступ к справочному центру</li>
        </ul>
        @if($buy)
            <button
                wire:click="subscribe({{ $item->id }})"
                type="button"
                class="w-100 btn btn-lg btn-primary"
            >
                Оформить
            </button>
        @endif
    </div>
</div>
