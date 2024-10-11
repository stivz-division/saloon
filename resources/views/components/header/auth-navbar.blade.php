<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a
                    class="navbar-brand"
                    href="{{ route('welcome') }}"
            >
                <img
                        src="{{ Vite::asset('resources/images/Scottie_glasses.png') }}"
                        class="img-fluid"
                        style="max-height: 40px;"
                        alt="LOGO"
                >
                <span class="badge text-bg-primary">
                    {{ auth()->user()->account_type->name() }}
                </span>
            </a>
            <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                    class="collapse navbar-collapse justify-content-end"
                    id="navbarSupportedContent"
            >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <x-header.item route="welcome">Главная</x-header.item>
                    </li>

                    <li class="nav-item">
                        <x-header.item route="client.advertisement.list">Заявки</x-header.item>
                    </li>

                    <li class="nav-item">
                        <x-header.item route="master.advertisement.list">Услуги</x-header.item>
                    </li>

                    <li class="nav-item">
                        <x-header.item route="workers">Мастера и Салоны</x-header.item>
                    </li>

                    <li class="nav-item">
                        <x-header.item route="profile">Профиль</x-header.item>
                    </li>

                    <li class="nav-item">
                        <x-header.item route="tariff">Тарифы</x-header.item>
                    </li>

                </ul>
                <form
                        method="post"
                        action="{{ route('logout') }}"
                >
                    @csrf
                    @if(auth()->user()->isClient())
                        @include('components.shared.client-advertisement-link')
                    @endif

                    @if(auth()->user()->isMaster())
                        @include('components.shared.subscription-link')
                        @include('components.shared.master-advertisement-link')
                    @endif
                    <button class="btn btn-outline-danger">Выйти</button>
                </form>
            </div>
        </div>
    </nav>
</div>
