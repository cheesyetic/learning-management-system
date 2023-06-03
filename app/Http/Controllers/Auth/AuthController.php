<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $check = DB::table('password_resets')->where('token', $token)->first();
        if (!$check) return redirect()->route('login')->with('error', 'Token tidak ditemukan');

        $user = User::where('email', $check->email)->first();

        return view('content.auth.reset-password', compact('user'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required',
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
            'email' => 'required',
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
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $token = uniqid("", true);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'Kami sudah mengirimkan link reset password ke email anda!');
    }

    public function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session()->flush();

        return redirect()->route('login');
    }
}
