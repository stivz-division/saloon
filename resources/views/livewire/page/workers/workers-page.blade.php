<div>
    <h1>Мастера и Салоны</h1>

    @if($masters->count())
        <div class="row row-cols-1 row-cols-lg-3 mb-3 g-2">
            @foreach($masters as $master)

                @if($master->avatar_path === null || empty($master->infoMaster->about))
                    @continue
                @endif

                <div class="col">
                    @include('livewire.page.workers.shared.master-card')
                </div>
            @endforeach
        </div>

        {{ $masters->links() }}
    @else
        <h3>Пока нет мастеров!</h3>
    @endif
</div>