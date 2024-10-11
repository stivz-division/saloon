<div>
    <table class="table">
        <thead>
        <tr>
            <th>Название</th>
            <th>Объявлений</th>
            <th>Срок размещения</th>
            <th>Цена</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tariffs as $tariff)
            <tr>
                <th>
                    {{ $tariff->name }}
                    @if($tariff->stock !== null)
                        <div class="text-muted small text-decoration-underline">
                            Действует до: {{ $item->stock->end_at->format('d.m.Y H:i') }}
                        </div>
                    @endif
                </th>
                <td>{{ $tariff->advertisement_count }} шт.</td>
                <td>{{ $tariff->published_days }} дней</td>
                <td>
                    @if($tariff->stock === null)
                        {{$tariff->price}}₽
                    @else
                        <span class="text-danger">
                           {{ $tariff->stock->price }}₽
                        </span>
                        <small
                                class="text-body-secondary text-decoration-line-through fw-light"
                                style="font-size: 20px"
                        >
                            {{$tariff->price}}₽
                        </small>
                        <span
                                class="text-danger"
                                style="font-size: 20px"
                        >
                    &nbsp;      -{{ $tariff->stock->percent }}%
                        </span>
                    @endif
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
