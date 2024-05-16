<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function view()
    {
        return view('app.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::where('email', $request->email)->where('is_active', 1)->first();
        if (!empty($user)) {
            return redirect()->back()->withErrors([
                'email' => 'ایمیل قبلا انتخاب شده است'
            ]);
        }
        $result = DB::transaction(function () use ($request) {
            $token = Str::random(32);
            $user = User::updateOrCreate([
                'email' => $request->email,
            ],
                [
                    'password' => Hash::make($request->password),
                    'verify_token' => $token,
                ]);
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعالسازی حساب کاربری',
                'body' => route('auth.activation.token', $token) . " : برای فعال سازی حساب کاربری بر روی لینک کلیک کنید"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@butikala.ir', 'butikala');
            $emailService->setSubject('فعالسازی حساب کاربری');
            $emailService->setTo($user->email);
            $messageService = new MessageService($emailService);
            $result = $messageService->send();

            return $result;

        });
        if ($result) {
            return redirect()->route('auth.login.form')->with('swal-success', 'لینک فعال سازی برای ایمیل ارسال شد لطفا ایمیل خود را بررسی کنید');
        }
        return redirect()->back()->with('toast-error', 'خطا در ارسال ایمیل');

    }

    public function activation($token)
    {
        $user = User::where('verify_token', $token)->first();
        if (!empty($user)) {
            if ($user->is_active == 1) {
                return redirect()->route('auth.login.form')->with('toast-success', 'حساب کاربری فعال است');
            } else {
                $user->is_active = 1;
                $user->status = 1;
                $user->activation = 1;
                $user->save();
            }
            return redirect()->route('auth.login.form')->with('swal-success', 'حساب کاربری با موفقیت فعال شد');
        }
        return redirect()->route('home')->with('toast-error', 'لینک نامعتبر');
    }
}
