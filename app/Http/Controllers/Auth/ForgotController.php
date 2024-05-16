<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotController extends Controller
{
    public function view()
    {
        return view('app.auth.forgot');
    }

    public function forgot(ForgotRequest $request)
    {
        if (!empty(Session::get('forgot_time')) && Session::get('forgot_time') > time()) {
            return redirect()->back()->with('toast-error', 'بعد از یک دقیقه امتحان کنید');
        } else {
            Session::put('forgot_time', time() + 60);
            $user = User::where('email', $request->email)->first();
            if (empty($user)) {
                return redirect()->back()->withErrors([
                    'email' => 'کاربری با این مشخصات یافت نشد'
                ]);
            }
            $token = Str::random(32);
            $user->remember_token = $token;
            $user->remember_token_expire = date('Y-m-d H:i:s', time() + 600);
            $user->save();

            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فراموشی رمز عبور',
                'body' => route('auth.reset-password.form', $token) . " : برای تغییر رمز عبور بر روی لینک کلیک کنید"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@butikala.ir', 'butikala');
            $emailService->setSubject('فراموشی رمز عبور');
            $emailService->setTo($user->email);
            $messageService = new MessageService($emailService);
            $result = $messageService->send();
            if ($result) {
                return redirect()->route('home')->with('swal-success', 'لینک تغییر رمز عبور با موفقیت به ایمیل ارسال شد');
            }
            return redirect()->back()->with('toast-error', 'خطا در ارسال ایمیل');


        }
    }
}
