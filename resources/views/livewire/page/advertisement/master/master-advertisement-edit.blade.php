<div>
    <h1>Редактирование объявления</h1>


    <form wire:submit.prevent="updateAdvertisement">
        <div class="p-3 rounded-4 bg-light mb-3">
            <h2>Основное</h2>

            @include('livewire.page.advertisement.master.shared.name')

            @include('livewire.page.advertisement.master.shared.description')

            @include('livewire.page.advertisement.master.shared.pet-category')

            @include('livewire.page.advertisement.master.shared.pet-weight')

            @if(collect($animals)->pluck('value')->contains($dogAnimal->id))
                @include('livewire.page.advertisement.master.shared.breed')
            @endif

            @include('livewire.page.advertisement.master.shared.price')

        </div>


        @include('livewire.page.advertisement.master.shared.date')

        @include('livewire.page.advertisement.master.shared.location')

        @if($masterAdvertisement->images()->count())
            <div class="p-3 rounded-4 bg-light mb-3">
                <h2 class="mb-0">Загруженные фотографии</h2>
                <div class="row row-cols-auto g-1">
                    @foreach($masterAdvertisement->images() as $image)
                        <div class="col p-1 position-relative">
                            <span
                                    wire:click="deleteImage({{ $image->id }})"
                                    class="badge text-bg-danger position-absolute end-0"
                                    style="top: 5px"
                            >
                                <i class="bi bi-x-circle"></i>
                            </span>
                            <img
                                    class="img-fluid"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 25px"
                                    src="{{ $image->getFullUrl() }}"
                                    alt="SERVICE IMAGE"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

        @endif

        @include('livewire.page.advertisement.master.shared.phone')


        <input
                class="btn btn-primary"
                type="submit"
                value="Изменить"
        >

    </form>


</div>
