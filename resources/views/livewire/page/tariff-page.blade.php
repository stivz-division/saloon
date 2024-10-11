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
    <div class="container text-center text-nowrap">
        <p class="mb-0"> ИНН: 781129398703 | Вилков Сергей Андреевич | Р/сч 40817810055178663936 | БИК 044030653 </p>
        <p> СЕВЕРО-ЗАПАДНЫЙ БАНК ПАО СБЕРБАНК | К/сч 30101810500000000653 </p>
        <p> Email: 9219201792@mail.ru | Тел.: +7 921 920-17-92 </p>
        <p> Для переводов в валюте: </p>
        <p class="mb-0"> Beneficiary name: VILKOV SERGEI ANDREEVICH </p>
        <p class="mb-0"> Beneficiary account: 40817810055178663936 </p>
        <p class="mb-0"> Beneficiary bank: Sberbank, Moscow, Russian Federation </p>
        <p class="mb-0"> SWIFT-код: SABRRUMM </p>
        <p class="mb-0"> Correspondent Bank (EUR): Deutsche Bank AG, Frankfurt am Main </p>
        <p class="mb-0"> Correspondent SWIFT (EUR): DEUTDEFF </p>
        <p class="mb-0"> Correspondent Bank (USD): The Bank of New York Mellon, New York </p>
        <p class="mb-0"> Correspondent SWIFT (USD): IRVTUS3N </p>
    </div>
</div>
