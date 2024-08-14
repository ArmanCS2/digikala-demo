<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;

class Base extends Component
{
    public function render()
    {
        return view('livewire.task.base')->extends('livewire.layouts.master')->section('content');
    }
}
