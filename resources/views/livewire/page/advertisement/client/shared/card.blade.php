<h1>
    {{--    Заявка {{ $advertisement->id }}--}}
</h1>

@if($published && $advertisement->is_published)
    <div class="badge rounded-pill text-bg-success mb-3">ПУБЛИКУЕТСЯ</div>
@endif

<div class="p-3 rounded-4 bg-light mt-1">
    <h4
            class="mb-0"
            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
    >
        {{ $advertisement->description }}
    </h4>
    <div class="mb-3 small text-muted">
        {{ $advertisement->published_at->toDateTimeString() }}
    </div>
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
        {{--        <h2>Локация</h2>--}}

        <h5>{{ $advertisement->yandexLocation->location }}</h5>

    </div>
@endif

@if($advertisement->datetime_service_at)
    <div class="p-3 rounded-4 bg-light mb-3">
        <h6>Желаемая дата оказания услуги</h6>

        {{ $advertisement->datetime_service_at->toDateTimeString() }}

        @if($advertisement->datetime_service_at->isPast() === false)
            <span class="badge rounded-pill text-bg-success">ЕЩЕ МОЖНО УСПЕТЬ</span>
        @endif

    </div>
@endif
