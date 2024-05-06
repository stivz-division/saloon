<div>
    <h2>Предоставляемые услуги</h2>

    <x-alert.block/>

    @if($services->count())

        <ol class="list-group list-group-numbered mt-1">

            @foreach($services as $service)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                            {{ $service->title }}
                            <a
                                    wire:click.prevent="deleteService({{ $service->id }})"
                                    class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            >Удалить</a>
                        </div>
                        {{ $service->description }}
                    </div>
                    <span class="badge text-bg-primary rounded-pill">
                        {{ number_format($service->price, 0, '.', ' ') }} руб.
                    </span>
                </li>
            @endforeach
        </ol>

        <hr>
    @endif


    <form wire:submit.prevent="storeService">

        <div class="mb-3">
            <label for="title" class="form-label">Название услуги</label>
            <input wire:model="title" type="text" class="form-control"
                   id="title"
                   placeholder="Название услуги" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание услуги</label>
            <textarea wire:model="description" class="form-control" name="description" id="description"
                      rows="4" required></textarea>
        </div>


        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input wire:model="price" type="number" step="1" min="0" class="form-control"
                   id="price"
                   placeholder="Цена услуги" required>
        </div>

        <input class="btn btn-primary" type="submit" value="Создать">

    </form>

</div>
