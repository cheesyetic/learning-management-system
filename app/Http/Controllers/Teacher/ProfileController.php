<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('content.general.profile.edit');
    }

    public function security()
    {
        return view('content.general.profile.security');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        if ($request->hasFile('photo_profile')) {
            $request->validate([
                'photo_profile' => 'mimes:jpg,jpeg,png|max:5012',
            ]);

            $file = $request->file('photo_profile');
            $fileName = time() . '.' . $request->photo_profile->extension();
            $file->storeAs('uploads', $fileName, 'public');
            $path = '/storage/uploads/' . $fileName;
            $user->photo_profile = $path;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diubah!');
    }

    public function change_password(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validated['password'] == $validated['old_password']) {
            return redirect()->back()->with('errors', 'Password baru tidak boleh sama dengan password lama!');
        }

        $user = User::where('id', auth()->user()->id)->first();

        if (Hash::check($validated['old_password'], $user->password)) {
            $user->password = Hash::make($validated['password']);
            $user->save();
            return redirect()->back()->with('success', 'Password berhasil diubah!');
        } else {
            return redirect()->back()->with('errors', 'Password lama tidak sesuai!');
        }
    }
}
