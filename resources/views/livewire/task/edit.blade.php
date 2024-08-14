<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش</h5>
                <button wire:click="$emit('hideEditForm')" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="edit">

                    <div class="mb-3">
                        <label class="form-label">عنوان</label>
                        <input wire:model.defer="title" type="text" class="form-control">
                        @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">توضیحات</label>
                        <textarea wire:model.defer="description" rows="3" class="form-control"></textarea>
                        @error('description')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">وضعیت</label>
                        <select wire:model.defer="status" class="form-control">
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
                        <div wire:loading wire:target="edit">
                            <div class="spinner-border spinner-border-sm"></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

