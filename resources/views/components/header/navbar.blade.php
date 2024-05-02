<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                LOGO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                <div>
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>
                    <a class="btn btn-outline-success" href="{{ route('register') }}">Регистрация</a>
                </div>
            </div>
        </div>
    </nav>
</div>