<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginproses(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required||min:3|max:255',
            'password' => 'required|min:3|max:255',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            notify()->success('You are logged in', 'Success');

            return redirect()->route('dashboard');
        }

        notify()->error('Password or Username is wrong', 'Failed');

        return redirect()->back();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerproses(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|min:3|max:255',
            'username' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:255',
        ]);

        $validated['password'] = Hash::make($request->password);

        User::create($validated);

        notify()->success('You are registered', 'Success');

        return redirect()->route('login');

    }

    public function logout()
    {
        Auth::logout();

        notify()->success('You are logged out', 'Success');

        return redirect()->route('login');
    }
}
