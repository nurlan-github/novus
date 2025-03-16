<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Faqat login qilgan foydalanuvchilar kirishi mumkin
    }

    // Profilni ko'rish sahifasi
    public function edit()
    {
        $user = Auth::user(); // Login qilgan foydalanuvchini olish
        return view('profile.edit', compact('user'));
    }

    // Profilni yangilash
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validatsiya
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ismni yangilash
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        // Emailni yangilash
        if ($request->filled('email') && $user->email !== $request->email) {
            $user->email = $request->email;
        }

        // Parolni yangilash (agar kiritilgan bo'lsa)
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
