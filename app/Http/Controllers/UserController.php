<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Старый пароль введён неверно']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Пароль успешно изменён.');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'image|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = 'storage/' . $path;
            $user->save();
        }

        return back()->with('success', 'Аватар обновлён.');
    }
}
