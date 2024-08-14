<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mockery\Exception;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function login()
    {
        $this->validate();
        try {
            $user = User::where('email', $this->email)->first();
            if (empty($user)) {
                session()->flash('error', 'کاربری با این مشخصات یافت نشد');
            } elseif (Hash::check($this->password, $user->password)) {
                Auth::login($user);
                session()->flash('success', 'با موفقیت وارد حساب کاربری خود شدید');
                return redirect()->route('livewire.index');
            } else {
                session()->flash('error', 'رمز عبور اشتباه است');
            }
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
        }

    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
