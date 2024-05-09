<h1>
    Заявка {{ $advertisement->id }}
</h1>

@if($published && $advertisement->is_published)
    <div class="badge rounded-pill text-bg-success mb-3">ПУБЛИКУЕТСЯ</div>
@endif

<div class="p-3 rounded-4 bg-light mb-3">
    <p class="mb-0">
        {{ $advertisement->description }}
    </p>
</div>

@if($contacts)
    @include('livewire.page.advertisement.client.shared.contacts')
@endif

<div class="p-3 rounded-4 bg-light mb-3">
    @include('livewire.page.profile.client.shared.pet-card', [
        'pet' => $advertisement->pet,
        'delete' => false
    ])
</div>

@if($advertisement->yandexLocation)
    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Локация</h2>

        {{ $advertisement->yandexLocation->location }}

    </div>
@endif

@if($advertisement->datetime_service_at)
    <div class="p-3 rounded-4 bg-light mb-3">
        <h2>Желаемая дата оказания услуги</h2>

        {{ $advertisement->datetime_service_at->toDateTimeString() }}

        @if($advertisement->datetime_service_at->isPast() === false)
            <span class="badge rounded-pill text-bg-success">ЕЩЕ МОЖНО УСПЕТЬ</span>
        @endif

    </div>
@endif