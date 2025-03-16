<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Permissionlar bilan ruxsatni tekshirish
        $this->middleware('permission:show_languages')->only(['index']);
        $this->middleware('permission:create_languages')->only(['create', 'store']);
        $this->middleware('permission:edit_languages')->only(['edit', 'update']);
        $this->middleware('permission:delete_languages')->only(['destroy']);
    }

    // Barcha tillarni ko'rish
    public function index()
    {

        $languages = Language::paginate(10);
        return view('admin.languages.index', compact('languages'));
    }

    // Yangi til yaratish sahifasi
    public function create()
    {
        return view('admin.languages.create');
    }

    // Yangi til saqlash
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:languages',
            'name' => 'required|string|max:50',
            'is_default' => 'nullable|boolean',
            'flag' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'rtl' => 'nullable|boolean',
        ]);

        // Agar yangi til default bo'lsa, oldingi default tilni o'chirish
        if ($request->is_default) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        Language::create($request->all());

        return redirect()->route('languages.index')->with('success', 'Language created successfully.');
    }

    // Tilni tahrirlash sahifasi
    public function edit(Language $language)
    {
        return view('admin.languages.edit', compact('language'));
    }

    // Tilni yangilash
    public function update(Request $request, Language $language)
    {
        $request->validate([
            'code' => 'required|string|max:10|unique:languages,code,' . $language->id,
            'name' => 'required|string|max:50',
            'is_default' => 'nullable|boolean',
            'flag' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'rtl' => 'nullable|boolean',
        ]);

        // Agar yangi til default bo'lsa, oldingi default tilni o'chirish
        if ($request->is_default) {
            Language::where('is_default', true)->update(['is_default' => false]);
        }

        $language->update($request->all());

        return redirect()->route('languages.index')->with('success', 'Language updated successfully.');
    }

    // Tilni o'chirish
    public function destroy(Language $language)
    {
        $language->delete();

        return redirect()->route('languages.index')->with('success', 'Language deleted successfully.');
    }
}
