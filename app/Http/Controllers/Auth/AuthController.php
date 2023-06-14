<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function show_login()
    {
        return view('content.auth.login');
    }

    public function show_register()
    {
        return view('content.auth.register');
    }

    public function show_forgot_password()
    {
        return view('content.auth.forgot-password');
    }

    public function show_reset_password($token)
    {
        return view('content.auth.reset-password', compact('token'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        if ($request->role == 'student') {
            $request->validate([
                'name' => 'required',
                'class' => 'required',
                'absence_number' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'class' => $request->class,
                'absence_number' => $request->absence_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        }

        Auth::guard('web')->login($user, true);

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) return redirect()->back()->with('errors', 'Email tidak ditemukan!');

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('errors', 'Password salah!');
    }

    public function forgot_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session()->flush();

        return redirect()->route('login');
    }
}
