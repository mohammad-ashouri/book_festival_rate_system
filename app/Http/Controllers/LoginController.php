<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mews\Captcha\Captcha;
use Jenssegers\Agent\Agent;

class LoginController extends Controller
{
//    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function getCaptcha(Captcha $captcha)
    {
        $captcha->builder()->build();
        session(['captcha' => $captcha->builder()->getPhrase()]);
        return $captcha->response();
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('web')->only('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        Auth::logout();
        return view('login');
    }

    public function login(Request $request)
    {

        if (!$request->input('username')) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'username' => ['نام کاربری وارد نشده است.']
                ]
            ]);
        } elseif (!$request->input('password')) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'password' => ['رمز عبور وارد نشده است.']
                ]
            ]);
        } elseif (!$request->input('captcha')) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'captcha' => ['کد امنیتی وارد نشده است.']
                ]
            ]);
        }

        $captcha = $request->input('captcha');
        $sessionCaptcha = session('captcha')['key'];
        if (!password_verify($captcha, $sessionCaptcha)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'captcha' => ['کد امنیتی صحیح وارد نشده است.']
                ]
            ]);
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            Session::put('username', $request->input('username'));
            $user = User::where('username', $request->input('username'))->first();
            $userID=$user['id'];
            Session::put('id', $userID);
            return response()->json([
                'success' => true,
                'redirect' => route('dashboard')
            ]);
        }
        return response()->json([
            'success' => false,
            'errors' => [
                'loginError' => ['نام کاربری یا رمز عبور اشتباه است.']
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }
}
