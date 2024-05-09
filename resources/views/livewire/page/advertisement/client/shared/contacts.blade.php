<div class="p-3 rounded-4 bg-light mb-3">
    <h2>
        {{ $advertisement->user->name }} {{ $advertisement->user->surname }}
    </h2>
    <div>Контакты:</div>
    <ul class="list-group">
        <li class="list-group-item">
            Email:
            <a href="mailto:{{ $advertisement->user->email }}">
                {{ $advertisement->user->email }}
            </a>
        </li>
        @if($advertisement->user->phone)
            <li class="list-group-item">
                Номер телефона:
                <a href="tel:{{ $advertisement->user->phone }}">
                    {{ $advertisement->user->phone }}
                </a>
            </li>
        @endif
        @if($advertisement->user->dop_phone)
            <li class="list-group-item">
                Доп. телефон:
                <a href="tel:{{ $advertisement->user->dop_phone }}">
                    {{ $advertisement->user->dop_phone }}
                </a>
            </li>
        @endif
        @if($advertisement->user->telegram)
            <li class="list-group-item">
                Telegram:
                <a href="https://t.me/{{ $advertisement->user->dop_phone }}">
                    {{ $advertisement->user->telegram }}
                </a>
            </li>
        @endif
        @if($advertisement->user->whatsapp)
            <li class="list-group-item">
                WhatsApp:
                <a href="https://wa.me/{{ $advertisement->user->whatsapp }}">
                    {{ $advertisement->user->whatsapp }}
                </a>
            </li>
        @endif
    </ul>
</div>