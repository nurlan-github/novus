<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendKey;
use App\Models\KeysTranslate;
use App\Models\Language;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    public function index()
    {
        $keys = FrontendKey::with('translations.language')->get();
        return view('admin.keys.index', compact('keys'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $keys = FrontendKey::where('key', 'LIKE', '%' . $query . '%')
            ->with(['translations.language'])
            ->get();
        return response()->json($keys);
    }


    public function create()
    {
        $languages = Language::where('is_active', true)->get();
        return view('admin.keys.create', compact('languages'));
    }

    public function store(Request $request)
    {
        try {
            // Validasiyani tekshirish
            $request->validate([
                'key' => 'required|unique:frontend_keys,key'
            ]);

            // Yangi FrontendKey yaratish
            $frontendKey = FrontendKey::create(['key' => $request->key]);

            // Har bir til uchun value saqlash
            foreach ($request->values as $lang_id => $value) {
                if ($value) {
                    KeysTranslate::create([
                        'frontend_key_id' => $frontendKey->id,
                        'language_id' => $lang_id,
                        'value' => $value,
                    ]);
                }
            }

            return redirect()->route('keys.index')->with('success', 'Key created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            // SQL xatoliklar uchun
            return redirect()->back()->withInput()->with('error', 'Database Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Boshqa xatoliklar uchun
            return redirect()->back()->withInput()->with('error', 'Unexpected Error: ' . $e->getMessage());
        }
    }

    public function edit(FrontendKey $key)
    {
        $languages = Language::where('is_active', true)->get();
        $translations = $key->translations->keyBy('language_id');
        return view('admin.keys.edit', compact('key', 'languages', 'translations'));
    }

    public function update(Request $request, FrontendKey $key)
    {
        foreach ($request->values as $lang_id => $value) {
            // NULL bo'lsa, bo'sh string sifatida saqlaymiz
            $value = $value ?? '';

            KeysTranslate::updateOrCreate(
                ['frontend_key_id' => $key->id, 'language_id' => $lang_id],
                ['value' => $value]
            );
        }
        return redirect()->route('keys.index')->with('success', 'Key updated successfully.');
    }

}
