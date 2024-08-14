<?php

namespace App\Http\Livewire\Chat;

use App\Models\Room;
use Livewire\Component;

class Rooms extends Component
{
    public $title;
    public $slug;

    protected $rules=[
        'title'=>'required|string',
        'slug'=>'required|string',
    ];
    public function create()
    {
        $this->validate();
        Room::create([
            'title'=>$this->title,
            'slug'=>$this->slug,
        ]);
        $this->reset();
    }

    public function delete(Room $room)
    {
        $room->delete();
    }
    public function render()
    {
        return view('livewire.chat.rooms',['rooms'=>Room::all()])->extends('livewire.layouts.master')->section('content');
    }
}
