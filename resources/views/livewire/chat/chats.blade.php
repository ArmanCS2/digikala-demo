<div class="row m-5 g-3">
    <div class="col-md-2">
        <div class="card shadow">
            <div class="card-header">
                <h4>{{ $room->title }}</h4>
            </div>
            <ul class="list-group list-group-flush">
                @if (!empty($users))
                    @foreach ($users as $user)
                        <li id="user-{{ $user['id'] }}" class="list-group-item">
                            {{ $user['name'] }}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header">
                <h4>پیام ها</h4>
            </div>
            <div class="card-body" style="height: 300px;overflow-y: auto;">
                @foreach ($messages as $message)
                    <div class="mb-3 pb-2 border-bottom">
                        <div>
                            <strong>{{ $message->user->fullName }} :</strong>
                            <span class="ms-2">{{ $message->created_at }}</span>
                        </div>
                        <div class="ms-2 my-2">{{ $message->text }}</div>
                    </div>
                @endforeach
            </div>

            <div class="card-body">
                <form wire:submit.prevent="create">
                    <div class="mb-3">
                        <textarea wire:model="text" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-secondary btn-block" type="submit"> Send</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
