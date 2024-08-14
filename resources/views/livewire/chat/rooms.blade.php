<div class="row">
    <div class="col-md-4 mt-5 ms-3">
        <h5 class="text-center text-muted">ایجاد روم جدید :</h5>
        <form wire:submit.prevent="create">

            <div class="mb-3">
                <label class="form-label">عنوان</label>
                <input wire:model.lazy="title" type="text" class="form-control">
                @error('title')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">اسلاگ</label>
                <input wire:model.lazy="slug" type="text" class="form-control">
                @error('slug')
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
    <div class="col-md-7 mt-5">
        <div class="col-sm-4 col-md-3 mt-5">
            <div class="card shadow">
                <div class="card-header">
                    <h4>روم ها</h4>
                </div>
                <div class="list-group list-group-flush">
                    @foreach ($rooms as $room)
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="text-decoration-none m-1" href="{{route('livewire.chat.chats',[$room])}}">{{ $room->title }}</a>
                            <button wire:click="delete({{$room->id}})" wire:loading.attr="disabled" wire:target="delete({{$room->id}})" class="btn btn-danger btn-sm m-1">حذف</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
