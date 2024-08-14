<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Index extends Component
{
    public $showRegisterForm = false;

    protected $listeners = ['changeView' => 'changeShowRegisterForm'];

    public function changeShowRegisterForm()
    {
        $this->showRegisterForm = $this->showRegisterForm ? false : true;
    }

    public function render()
    {
        return view('livewire.auth.index')->extends('livewire.layouts.master')->section('content');
    }
}
