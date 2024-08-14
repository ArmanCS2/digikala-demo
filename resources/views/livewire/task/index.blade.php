<div class="m-5">
    <form class="row d-flex justify-content-start align-items-end mb-2">

        <div class="col-auto">
            <label class="form-label">عنوان</label>
            <input wire:model="title" type="text" class="form-control">
        </div>

        <div class="col-auto">
            <label class="form-label">وضعیت</label>
            <select wire:model="status" class="form-control">
                <option value="">
                    همه
                </option>
                <option value="0">
                    در حال انجام...
                </option>
                <option value="1">
                    انجام شده
                </option>
            </select>
        </div>

    </form>
    <table class="table table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">عنوان</th>
            <th scope="col">توضیحات</th>
            <th scope="col">وضعیت</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $key => $task)
            <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>{{$task->status()}}</td>
                <td>
                    <div class="d-flex">
                        <div>
                            <button wire:click="$emitTo('task.edit','showEditModal',{{$task->id}})" class="btn btn-primary">ویرایش</button>
                        </div>
                        <div>
                            <button wire:click="delete({{$task->id}})" class="btn btn-danger">حذف</button>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$tasks->links()}}
    </div>
</div>
