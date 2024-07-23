<div class="p-3 rounded-4 bg-light">
    <h2>Подписка</h2>
    @if($user->subscription)
        <div style="max-width: 300px">
            @include('livewire.page.subscription.card', [
            'item' => $user->subscription,
            'buy' => false
        ])
        </div>
    @else
        <h3>У вас нет активной подписки!</h3>
        @include('components.shared.subscription-link')
    @endif
</div>