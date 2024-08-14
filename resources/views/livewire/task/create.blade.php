<div class="m-5">
    <h5 class="text-center text-muted">ایجاد وظیفه جدید :</h5>
    <form wire:submit.prevent="create">

        <div class="mb-3">
            <label class="form-label">عنوان</label>
            <input wire:model.lazy="title" type="text" class="form-control">
            @error('title')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">توضیحات</label>
            <textarea wire:model.lazy="description" rows="3" class="form-control"></textarea>
            @error('description')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">وضعیت</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="0">
                    در حال انجام...
                </option>
                <option value="1">
                    انجام شده
                </option>
            </select>
            @error('status')
            <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">
            ثبت
            <div wire:loading wire:target="create">
                <div class="spinner-border spinner-border-sm"></div>
            </div>
        </button>
    </form>
</div>
