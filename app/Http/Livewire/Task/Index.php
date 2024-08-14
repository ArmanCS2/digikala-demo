<?php

namespace App\Http\Livewire\Task;

use App\Models\Livewire\LivewireTask;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use withPagination;

    public $title;
    public $status;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh' => '$refresh'];

    public function delete(LivewireTask $task)
    {
        $task->delete();
        $this->emitTo('task.notification', 'flashMessage', 'success','وظیفه با موفقیت حذف شد');
    }

    public function render()
    {
        $title = $this->title;
        $status = $this->status;
        return view('livewire.task.index', ['tasks' => LivewireTask::when($title, function ($query) use ($title, $status) {
            return $query->where('title', 'like', "%$title%");
        })->when(isset($status) && trim($status) != '', function ($query) use ($status) {
            return $query->where('status', $status);
        })->orderBy('created_at', 'desc')->paginate(5)]);
    }
}
