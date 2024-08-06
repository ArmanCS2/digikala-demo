<div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}<strong wire:click="$emitUp('changeView')" style="cursor: pointer"> ورود </strong>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h5 class="text-center text-muted">ثبت نام</h5>
    <form wire:submit.prevent="register" >
        <div class="mb-3">
            <label class="form-label">نام</label>
            <input wire:model.lazy="name" type="text" class="form-control">
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">ایمیل</label>
            <input wire:model.lazy="email" type="text" class="form-control">
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">رمز</label>
            <input wire:model.lazy="password"  type="password" class="form-control">
            @error('password')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">تایید رمز</label>
            <input wire:model.lazy="password_confirmation"  type="password" class="form-control">
            @error('password_confirmation')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">
            ثبت
            <div wire:loading wire:target="register" >
                <div class="spinner-border spinner-border-sm"></div>
            </div>
        </button>

        <div wire:click="$emitUp('changeView')" class="text-center mt-3">
            <span  style="cursor: pointer">اکانت دارید ؟ ورود</span>
        </div>
    </form>
</div>
