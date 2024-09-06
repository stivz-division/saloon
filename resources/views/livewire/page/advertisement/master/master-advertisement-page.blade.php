<div>
    <h1>Добавление объявления</h1>


    <form wire:submit.prevent="save">
        <div class="p-3 rounded-4 bg-light mb-3">
            <h2>Основное</h2>

            @include('livewire.page.advertisement.master.shared.name')

            @include('livewire.page.advertisement.master.shared.description')

            @include('livewire.page.advertisement.master.shared.pet-category')

            @include('livewire.page.advertisement.master.shared.pet-weight')

            @include('livewire.page.advertisement.master.shared.breed')

            @include('livewire.page.advertisement.master.shared.price')

        </div>


        @include('livewire.page.advertisement.master.shared.date')

        @include('livewire.page.advertisement.master.shared.location')

        @include('livewire.page.advertisement.master.shared.phone')

        <x-alert.block/>


        <input
                class="btn btn-primary"
                type="submit"
                value="Создать"
        >

    </form>


</div>
