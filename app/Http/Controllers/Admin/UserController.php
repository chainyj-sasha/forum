<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showAll()
    {
        $users = User::all();

        return view('admin.user.showAll', [
            'title' => 'Список юзеров',
            'users' => $users,
        ]);
    }

    public function active($id)
    {
        $user = User::find($id);
        if ($user->active) {
            $user->active = 0;
        } else {
            $user->active = 1;
        }
        $user->save();

        return redirect()->back();
    }

    public function status($id)
    {
        $user = User::find($id);

        if ($user->admin) {
            $user->admin = 0;
        } else {
            $user->admin = 1;
        }
        $user->save();

        return redirect()->back();
    }
}
