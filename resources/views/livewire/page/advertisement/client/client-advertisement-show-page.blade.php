<div>

    @if($advertisement->is_payment === false && $advertisement->isAuthor(auth()->id()))
        <livewire:page.advertisement.client.payment :advertisement="$advertisement"/>
    @endif

    @include('livewire.page.advertisement.client.shared.card', [
        'advertisement' => $advertisement,
        'contacts' => true,
        'published' => true
    ])

</div>
