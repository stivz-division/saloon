<div class="p-3 rounded-4 bg-light">
    <div class="d-flex align-items-center justify-content-start mb-2">
        <h2 class="me-2">Мои заявки</h2>
        @if($mode === $this::PUBLISHED_MODE)
            <button
                    class="btn btn-dark"
                    wire:click="changeMode('{{$this::ARCHIVED_MODE}}')"
            >
                Посмотреть архив ({{ $this->countArchived() }})
            </button>
        @elseif($mode === $this::ARCHIVED_MODE)
            <button
                    class="btn btn-primary"
                    wire:click="changeMode('{{$this::PUBLISHED_MODE}}')"
            >
                Посмотреть опубликованные ({{ $this->countPublished() }})
            </button>
        @endif

    </div>
    @if($advertisements->count())
        <div class="swiper master-advertisements-slider">
            <div class="swiper-wrapper">
                @foreach($advertisements as $advertisement)

                    <div class="swiper-slide bg-white p-3 rounded-3">
                        @include('livewire.page.advertisement.client.shared.card', [
                            'advertisement' => $advertisement,
                            'published' => true,
                            'contacts' => true,
                            'control' => true
                        ])
                    </div>

                @endforeach

            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    @else
        @if($mode === $this::PUBLISHED_MODE)
            @include('components.shared.master-advertisement-link')
        @elseif($mode === $this::ARCHIVED_MODE)
            В архиве пока ничего нет!
        @endif
    @endif

</div>


@push('scripts')
    @vite('resources/js/profile/master/advertisements-slider.js')
@endpush
