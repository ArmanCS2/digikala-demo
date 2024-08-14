<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;

class Base extends Component
{
    public $showCreateForm=false;
    protected $listeners=['changeView'];

    public function changeView()
    {
        $this->showCreateForm=!$this->showCreateForm;
    }
    public function render()
    {
        return view('livewire.product.base')->extends('livewire.layouts.master')->section('content');
    }
}
