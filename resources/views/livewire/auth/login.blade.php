<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h5 class="text-center text-muted">ورود</h5>
    <form wire:submit.prevent="login"  >

        <div class="mb-3">
            <label class="form-label">ایمیل</label>
            <input wire:model.lazy="email" type="email" class="form-control">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">رمز</label>
            <input wire:model.lazy="password" type="password" class="form-control">
            @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input wire:model.lazy="remember" type="checkbox" class="form-check-input">
            <label class="form-check-label">مرا به خاطر داشته باش</label>
        </div>

        <button type="submit" class="btn btn-dark">
            ورود
            <div wire:loading wire:target="login">
                <div class="spinner-border spinner-border-sm"></div>
            </div>
        </button>

        <div wire:click="$emitUp('changeView')" class="text-center mt-3">
            <span  style="cursor: pointer">اکانت ندارید ؟ ثبت نام</span>
        </div>
    </form>
</div>
