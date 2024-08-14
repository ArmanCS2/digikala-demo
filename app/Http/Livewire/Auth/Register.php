<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mockery\Exception;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|min:4|confirmed',
        'password_confirmation' => 'required'
    ];

    public function register()
    {
        $this->validate();
        try {
            $user = User::create([
                'first_name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
            session()->flash('success', 'با موفقیت ثبت نام شدید');
            $this->reset();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

    }

    public function updatedName()
    {
        $this->validateOnly('name');
    }

    public function updatedEmail()
    {
        $this->validateOnly('email');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
