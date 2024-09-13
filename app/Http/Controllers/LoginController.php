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
        ], );
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
        ], [
            'fullname.required' => 'Fullname is required',
            'fullname.min' => 'Fullname must be at least 3 characters',
            'fullname.max' => 'Fullname must not exceed 255 characters',
            'username.required' => 'Username is required',
            'username.unique' => 'Username already exists',
            'username.min' => 'Username must be at least 3 characters',
            'username.max' => 'Username must not exceed 255 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 3 characters',
            'password.max' => 'Password must not exceed 255 characters',
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
