<div>
    @if (session()->has('success'))
        <div class="alert alert-success mb-0">
            {{ session('success') }}
        </div>
    @endif
</div>