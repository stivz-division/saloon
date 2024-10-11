<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a
                    class="navbar-brand"
                    href="{{ route('welcome') }}"
            >
                {{--                LOGO--}}
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
                        <x-header.item route="tariff">Тарифы</x-header.item>
                    </li>

                </ul>
                <div class="social">
                    <div>
                        {{--                        Написать:--}}
                        <a
                                href="mailto:7921920@gmail.com"
                                target="_blank"
                        >
                            <img
                                    src="{{ Vite::asset('resources/images/email_logo.png') }}"
                                    alt="Email"
                                    style="width: 32px; height: 32px;"
                            >
                        </a>
                        <a
                                href="https://wa.me/79219201792"
                                target="_blank"
                        >
                            <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
                                    alt="WhatsApp"
                                    style="width: 40px; height: 40px;"
                            >
                        </a>
                        <a
                                href="https://t.me/Gerffin"
                                target="_blank"
                        >
                            <img
                                    src="https://telegram.org/img/t_logo.png"
                                    alt="Telegram"
                                    style="width: 32px; height: 32px;"
                            >
                        </a>
                    </div>
                    <div
                            class="space"
                            style="width: 150px;"
                    ></div>
                </div>
                <div>
                    <a
                            class="btn btn-outline-primary"
                            href="{{ route('login') }}"
                    >Вход</a>
                    <a
                            class="btn btn-outline-success"
                            href="{{ route('register') }}"
                    >Регистрация</a>
                </div>
            </div>
        </div>
    </nav>
</div>
