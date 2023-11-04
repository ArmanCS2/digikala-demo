<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Http\Services\Message\SMS\SmsService;
use App\Models\Auth\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('app.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request)
    {
        $inputs = $request->all();
        if (filter_var($inputs['id'], FILTER_VALIDATE_EMAIL)) {
            $type = 1;
            $user = User::where('email', $inputs['id'])->first();
            if (empty($user)) {
                $newUser['email'] = $inputs['id'];
            }
        } elseif (preg_match('/^(\+98|98|0)9\d{9}$/', $inputs['id'])) {
            $type = 0;
            //$mobile=ltrim($inputs['id'],'0');
            $mobile = $inputs['id'];
            $user = User::where('mobile', $mobile)->first();
            if (empty($user)) {
                $newUser['mobile'] = $mobile;
            }
        } else {
            $errorMessage = 'شماره موبایل یا ایمیل معتبر نیست';
            return redirect()->back()->withErrors(['id' => $errorMessage]);
        }

        if (empty($user)) {
            $newUser['password'] = Hash::make(Str::random(10));
            $newUser['activation'] = 1;
            $user = User::create($newUser);
        }

        $otpCode = rand(111111, 999999);
        $otpToken = Str::random(60);
        $otpInputs = [
            'token' => $otpToken,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' => $inputs['id'],
            'type' => $type
        ];

        Otp::create($otpInputs);

        if ($type == 0) {
            $smsService = new SmsService();
            $smsService->setTo($user->mobile);
            $text = "فروشگاه دیجی کالا (دمو)

            کد تایید : $otpCode

            وبسایت : armanafzali.ir";
            $smsService->setText($text);

            $messageService = new MessageService($smsService);

        } elseif ($type == 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعالسازی حساب کاربری',
                'body' => "کد فعالسازی : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@digikala.whi.ir', 'digikala');
            $emailService->setSubject('فعالسازی حساب کاربری');
            $emailService->setTo($inputs['id']);

            $messageService = new MessageService($emailService);
        }

        $result = $messageService->send();
        if (!$result) {
            return redirect()->back()->withErrors(['id' => 'خطا در ارسال کد تایید']);
        }

        return redirect()->route('auth.customer.login-confirm-form', $otpToken);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token', $token)->first();
        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form')->withErrors(['id' => 'آدرس وارد شده معتبر نیست']);
        }
        return view('app.auth.login-confirm', compact('token', 'otp'));
    }

    public function loginConfirm(LoginRegisterRequest $request, $token)
    {
        $otp = Otp::where('token', $token)->where('used', 0)->where('created_at', '>=', Carbon::now()->subMinute(1)->toDateTimeString())->first();

        if (empty($otp)) {
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['otp' => 'کد تایید معتبر نیست']);
        }
        $otp_code = $request->otp;
        if ($otp->otp_code == $otp_code) {
            $otp->update(['used' => 1]);
            $user = $otp->user;
            if ($otp->type == 0 && empty($user->mobile_verified_at)) {
                $user->update(['mobile_verified_at' => now()]);
            } elseif ($otp->type == 1 && empty($user->email_verified_at)) {
                $user->update(['email_verified_at' => now()]);
            }
            Auth::login($user);
            return redirect()->route('home');
        }
        return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['otp' => 'کد تایید معتبر نیست']);
    }

    public function loginResendOtp($token)
    {
        $otp = Otp::where('token', $token)->where('created_at', '<=', Carbon::now()->subMinute(1)->toDateTimeString())->first();
        if (empty($otp)){
            return redirect()->route('auth.customer.login-confirm-form', $token)->withErrors(['otp' => 'خطا در ارسال کد تایید']);
        }
        $user=$otp->user;
        $otpCode = rand(111111, 999999);
        $otpToken = Str::random(60);
        $otpInputs = [
            'token' => $otpToken,
            'user_id' => $user->id,
            'otp_code' => $otpCode,
            'login_id' =>$otp->login_id,
            'type' => $otp->type
        ];

        Otp::create($otpInputs);

        if ($otp->type == 0) {
            $smsService = new SmsService();
            $smsService->setTo($user->mobile);
            $text = "فروشگاه دیجی کالا (دمو)

            کد تایید : $otpCode

            وبسایت : armanafzali.ir";
            $smsService->setText($text);

            $messageService = new MessageService($smsService);

        } elseif ($otp->type == 1) {
            $emailService = new EmailService();
            $details = [
                'title' => 'ایمیل فعالسازی حساب کاربری',
                'body' => "کد فعالسازی : $otpCode"
            ];
            $emailService->setDetails($details);
            $emailService->setFrom('noreply@digikala.whi.ir', 'digikala');
            $emailService->setSubject('فعالسازی حساب کاربری');
            $emailService->setTo($otp->login_id);

            $messageService = new MessageService($emailService);
        }

        $result = $messageService->send();
        if (!$result) {
            return redirect()->back()->withErrors(['id' => 'خطا در ارسال کد تایید']);
        }

        return redirect()->route('auth.customer.login-confirm-form', $otpToken);

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
