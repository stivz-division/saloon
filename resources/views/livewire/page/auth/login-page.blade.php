<div>
    <div class="card mx-auto" style="max-width: 360px">
        <div class="card-header">Вход</div>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="card-body">
                
                <div class="mb-3">
                    <x-alert.block/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">E-Mail</label>
                    <input name="email" class="form-control" type="email" placeholder="Введите email" required>
                </div>
                <div>
                    <label class="form-label" for="password">Пароль</label>
                    <input name="password" class="form-control" type="password" placeholder="Введите пароль" required>
                </div>
            </div>

            <div class="card-footer text-end">
                <input class="btn btn-outline-primary" type="submit" value="Войти">
            </div>
        </form>
    </div>
</div>
