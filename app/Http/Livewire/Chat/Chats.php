<?php

namespace App\Http\Livewire\Chat;


use App\Models\Message;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chats extends Component
{
    public $room;
    public $messages;
    public $users;
    public $text;
    public function mount(Room $room)
    {
        $this->room=$room;
    }

    public function create()
    {
        $user=Auth::user();
        Message::create([
            'user_id' => $user->id,
            'room_id' => $this->room->id,
            'text' => $this->text,
        ]);
        $this->reset(['text']);
    }
    public function render()
    {
        $this->messages=$this->room->messages()->with('user')->get();
        return view('livewire.chat.chats')->extends('livewire.layouts.master')->section('content');
    }
}
