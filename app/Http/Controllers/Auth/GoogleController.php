<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // หา user จาก email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // สร้าง user ใหม่
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(uniqid()), // ไม่ได้ใช้จริง
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard'); // หรือหน้าแรกของคุณ
    }
}