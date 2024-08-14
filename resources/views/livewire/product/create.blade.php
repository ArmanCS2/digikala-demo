<div class="m-5 row">
    <div>
        <button wire:click="$emitTo('product.base','changeView')" class="btn btn-dark">محصولات</button>
    </div>
    <div class="col-md-6 offset-md-3">
        <h5 class="text-center text-muted">ایجاد محصول جدید :</h5>
        <form wire:submit.prevent="create">

            <div class="mb-3">
                <label class="form-label">عنوان</label>
                <input wire:model="title" type="text" class="form-control">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">توضیحات</label>
                <textarea wire:model="description" rows="3" class="form-control"></textarea>
                @error('description')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">قیمت</label>
                <input wire:model="price" type="text" class="form-control">
                @error('price')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">تصویر</label>
                <input wire:model.lazy="image" type="file" class="form-control">
                @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
                <div wire:loading wire:target="image" class="mt-1">
                    در حال بارگذاری...
                </div>
                @if(!empty($image))
                    <img width="200" class="mt-1" src="{{$image->temporaryUrl()}}">
                @endif
            </div>


            <button type="submit" class="btn btn-dark" wire:loading.attr="disabled" wire:target="image">
                ثبت
                <div wire:loading wire:target="create">
                    <div class="spinner-border spinner-border-sm"></div>
                </div>
            </button>
        </form>
    </div>
</div>
