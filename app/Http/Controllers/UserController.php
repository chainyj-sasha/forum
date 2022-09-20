<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create', [
            'title' => 'Регистрация пользователя',
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        $request->session()->flash('success', 'Регистрация прошла успешно!');

        return redirect()->route('section.index');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', [
            'title' => 'Просиотр профиля',
            'user' => $user,
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1,
        ])) {
            $request->session()->flash('success', 'Авторизация успешна!');
            return redirect()->back();
        }
        $request->session()->flash('error', 'Логин или пароль введены неверно');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
