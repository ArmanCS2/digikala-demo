<?php

namespace App\Http\Livewire\Task;

use App\Models\Livewire\LivewireTask;
use Livewire\Component;

class Edit extends Component
{
    public $task;
    public $title;
    public $description;
    public $status;
    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'status' => 'required|in:0,1'
    ];
    protected $listeners=['showEditModal'];
    public function showEditModal(LivewireTask $task)
    {
        $this->task=$task;
        $this->title=$task->title;
        $this->description=$task->description;
        $this->status=$task->status;
        $this->emit('showEditForm');
    }

    public function edit()
    {
        $this->validate();

        try {
            $this->task->update([
                'title'=>$this->title,
                'description'=>$this->description,
                'status'=>$this->status
            ]);
            $this->emitTo('task.notification', 'flashMessage', 'success','وظیفه با موفقیت ویرایش شد');
            $this->emitTo('task.index','refresh');
            $this->emit('hideEditForm');
        }catch (\Exception $exception){
            $this->emitTo('task.notification', 'flashMessage', 'error',$exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.task.edit');
    }
}
