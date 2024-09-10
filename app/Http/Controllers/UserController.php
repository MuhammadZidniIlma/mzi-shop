<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('dashboard.users.index', compact('users'));
    }

    public function profile()
    {
        return view('dashboard.users.profile');
    }

    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => [
                'required',
                'min:3',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|min:10|max:13',
            'address' => 'nullable|min:10|max:255',
            'country' => 'nullable|min:3|max:255',
            'city' => 'nullable|min:3|max:255',
            'postal_code' => 'nullable|min:3|max:255',
        ]);

        $user->update($validated);
        notify()->success('Profile updated successfully', 'Success');

        return redirect()->back();

    }

    public function changePassword()
    {
        return view('dashboard.users.change-password');
    }

    public function changePasswordProcess(Request $request, $id)
    {
        $validated = $request->validate([
            'old_password' => 'required|min:3|max:255',
            'new_password' => 'required|min:3|max:255',
            'confirm_password' => 'required|min:3|max:255',
        ]);

        $user = User::findOrFail($id);
        if (! Hash::check($validated['old_password'], $user->password)) {
            notify()->error('Old password is wrong', 'Failed');

            return redirect()->back();
        }
        if ($validated['new_password'] != $validated['confirm_password']) {
            notify()->error('New password and confirm password does not match', 'Failed');

            return redirect()->back();
        } else {
            $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);
            notify()->success('Password changed successfully', 'Success');

            return redirect()->back();
        }
    }

    public function uploadAvatar(Request $request, $id)
    {
        $validasi = $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            // Hapus gambar lama jika ada
            if ($user->avatar && file_exists(public_path('profile/'.$user->avatar))) {
                unlink(public_path('profile/'.$user->avatar));
            }

            // Simpan gambar baru
            $imageName = $user->username.'.'.$request->avatar->extension();
            $request->avatar->move(public_path('profile'), $imageName);

            // Update nama file gambar pada record user
            $validasi['avatar'] = $imageName;
        }

        $user->update($validasi);
        notify()->success('Avatar uploaded successfully', 'Success');

        return redirect()->back();
    }

    public function resetAvatar($id)
    {
        $user = User::findOrFail($id);
        if ($user->avatar && file_exists(public_path('profile/'.$user->avatar))) {
            unlink(public_path('profile/'.$user->avatar));
        }

        $user->update([
            'avatar' => null,
        ]);
        notify()->success('Avatar reset successfully', 'Success');

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|min:3|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:255',
            'role' => 'required',
        ]);
        $validated['password'] = Hash::make($request->password);

        User::create($validated);

        notify()->success('User data added successfully', 'Success');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|min:3|max:255',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        User::findOrFail($id)->update($validated);

        notify()->success('User data updated successfully', 'Success');

        return redirect()->back();
    }

    public function deactiveAccount($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'status' => 'inactive',
        ]);

        Auth::logout();
        notify()->success('User deactivated successfully', 'Success');

        return redirect()->route('login');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        notify()->success('User data deleted successfully', 'Success');

        return redirect()->back();
    }
}
