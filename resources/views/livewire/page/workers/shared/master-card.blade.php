<div
        class="card"
>
    @if($master->avatar_path)
        <img
                src="/storage/{{$master->avatar_path}}"
                style="height: 400px; object-fit: cover"
                class="card-img-top"
                alt="avatar master"
        >
    @endif

    <div class="card-body">
        <h5 class="card-title">
            {{ $master->surname }} {{ $master->name }}
        </h5>
        @if($master->infoMaster->about)
            <p class="card-text">
                {{ str($master->infoMaster->about)->limit(2000) }}
            </p>
        @endif


    </div>

    @if($master->infoMaster->canDopService())
        <div class="card-footer">
            @if($master->infoMaster->is_veterinarian)
                <span class="badge text-bg-primary">
                        Ветеринар
                    </span>
            @endif
            @if($master->infoMaster->is_delivering_pet)
                <span class="badge text-bg-primary">
                        Доставляю питомца
                    </span>
            @endif
            @if($master->infoMaster->is_home_check_out)
                <span class="badge text-bg-primary">
                        Выезжаю на дом
                    </span>
            @endif
            @if($master->infoMaster->is_at_home)
                <span class="badge text-bg-primary">
                        Принимаю у себя
                    </span>
            @endif
        </div>
    @endif

</div>