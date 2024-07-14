<div>
    <div class="card mx-auto" style="max-width: 600px">
        <div class="card-header">Регистрация</div>


        <form action="{{ route('register') }}" method="post">
            @csrf

            @if($ref !== null)

                <div class="p-3">
                    @include('components.shared.ref-card', [
                        'ref' => $ref
                    ])
                </div>

                <input type="hidden" name="ref_uuid" value="{{ $ref->uuid }}">
            @endif

            <div class="card-body">
                <div class="mb-3">
                    <x-alert.block/>
                </div>

                @if($ref === null)
                    <div class="mb-3">
                        <label class="form-label" for="account_type">Тип аккаунта</label>
                        <select wire:model.live="accountType" class="form-select" name="account_type" id="account_type"
                                aria-label="Тип аккаунта">
                            @foreach($accountTypes as $type)
                                <option value="{{ $type->value }}">{{ $type->name() }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="account_type" value="{{ $accountType }}">
                @endif


                @if($accountType === $saloonType)
                    <div class="mb-3">
                        <label class="form-label" for="name">Название салона</label>
                        <input name="name" class="form-control" type="text" placeholder="Введите название салона"
                               value="{{ old('name') }}"
                               required>
                    </div>
                @else
                    <div class="mb-3">
                        <label class="form-label" for="name">Имя</label>
                        <input name="name" class="form-control" type="text" placeholder="Введите имя"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="surname">Фамилия</label>
                        <input name="surname" class="form-control" type="text" placeholder="Введите фамилию"
                               value="{{ old('surname') }}"
                               required>
                    </div>
                @endif


                <div class="mb-3">
                    <label class="form-label" for="email">E-Mail</label>
                    <input name="email" class="form-control" type="email" placeholder="Введите email"
                           required>
                </div>


                <div class="mb-3">
                    <label class="form-label" for="password">Пароль</label>
                    <input name="password" class="form-control" type="password" placeholder="Введите пароль"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">Повторите пароль</label>
                    <input name="password_confirmation" class="form-control" type="password"
                           placeholder="Введите пароль повторно" required>
                </div>

                <div class="form-check">
                    <input class="form-check-input" name="accept_policy" type="checkbox" id="accept_policy" checked>
                    <label class="form-check-label" for="accept_policy">
                        Соглашаюсь c политикой обработки персональных данных и с пользовательским соглашеним
                    </label>
                </div>

            </div>

            <div class="card-footer text-end">
                <input class="btn btn-outline-primary" type="submit" value="Зарегистрироваться">
            </div>
        </form>

    </div>
</div>
