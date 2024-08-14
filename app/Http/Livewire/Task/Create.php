<?php

namespace App\Http\Livewire\Task;

use App\Models\Livewire\LivewireTask;
use Livewire\Component;
use Mockery\Exception;

class Create extends Component
{
    public $title;
    public $description;
    public $status=0;
    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
        'status' => 'required|in:0,1'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();
        try {
            LivewireTask::create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status
            ]);
            $this->emitTo('task.notification', 'flashMessage', 'success','وظیفه با موفقیت ایجاد شد');
            $this->emitTo('task.index','refresh');
            $this->reset();
        } catch (Exception $exception) {
            $this->emitTo('task.notification', 'flashMessage', 'error',$exception->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.task.create');
    }
}
