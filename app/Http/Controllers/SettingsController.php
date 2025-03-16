<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Faqat login qilgan foydalanuvchilar kirishi mumkin
    }

    // Sozlamalar sahifasini ko'rish
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    // Sozlamalarni yangilash
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validatsiya
        $request->validate([
            'language' => ['nullable', 'string', 'max:10'], // Til kodlari (uz, ru, en)
            'notifications_enabled' => ['nullable', 'boolean'], // Bildirishnomalar yoqilgan/yopilgan
            'theme_mode' => ['nullable', 'in:light,dark'], // Interfeys rejimi (light/dark)
        ]);

        // Tilni yangilash
        if ($request->filled('language')) {
            $user->settings()->updateOrCreate(
                ['key' => 'language'],
                ['value' => $request->language]
            );
        }

        // Bildirishnomalarni yangilash
        if ($request->has('notifications_enabled')) {
            $user->settings()->updateOrCreate(
                ['key' => 'notifications_enabled'],
                ['value' => $request->notifications_enabled ? 'true' : 'false']
            );
        }

        // Temani yangilash
        if ($request->filled('theme_mode')) {
            $user->settings()->updateOrCreate(
                ['key' => 'theme_mode'],
                ['value' => $request->theme_mode]
            );
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
}
