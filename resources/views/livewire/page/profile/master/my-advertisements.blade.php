<div class="p-3 rounded-4 bg-light">
    <h2>Мои услуги</h2>
    @if($advertisements->count())
        <div class="swiper master-advertisements-slider">
            <div class="swiper-wrapper">
                @foreach($advertisements as $advertisement)

                    <div class="swiper-slide">
                        @include('livewire.page.advertisement.master.shared.card', [
                            'control' => true
                        ])
                    </div>

                @endforeach

            </div>

            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    @else
        @include('components.shared.master-advertisement-link')
    @endif

</div>

@push('scripts')
    @vite('resources/js/profile/master/advertisements-slider.js')
@endpush
