<div class="col-md-4 offset-md-4 mt-5">
    <div class="card shadow rounded">
        <div class="card-body">
            <h4 class="my-4 text-center">Livewire</h4>
            @if ($showRegisterForm)
                @livewire('auth.register')
            @else
                @livewire('auth.login')
            @endif

        </div>
    </div>
</div>
