<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Добро пожаловать!');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6',
            'phone_number' => 'nullable',
        ]);

        $user = new User();
        $user->full_name = $request->full_name;
        $user->name = $request->name ?? null;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->save();

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Регистрация прошла успешно!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Вы вышли из системы.');
    }
}
