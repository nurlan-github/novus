<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show_categories')->only(['index']);
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:edit_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only(['destroy']);
    }

    public function index()
    {
        $categories = Category::with('translations')->get();
        $languages = Language::getActiveLanguages();
        return view('admin.categories.index', compact('categories', 'languages'));
    }

    public function create()
    {
        $languages = Language::getActiveLanguages();
        $categories = Category::all();
        $locale = App::getLocale();
        return view('admin.categories.create', compact('languages', 'categories', 'locale'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'is_active' => 'required|boolean',
                'translations' => 'required|array',
                'translations.*.name' => 'nullable|string|max:255',
                'translations.*.slug' => 'nullable|string|max:255',
                'translations.*.description' => 'nullable|string',
            ]);

            // Check for at least one translation
            $hasTranslation = false;
            foreach ($request->translations as $translation) {
                if (!empty($translation['name'])) {
                    $hasTranslation = true;
                    break;
                }
            }

            if (!$hasTranslation) {
                return redirect()->back()->withInput()->with('error', translate_key('error_translation_required'));
            }

            $category = Category::create([
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);

            foreach ($request->translations as $language_id => $translation) {
                if (!empty($translation['name'])) {
                    $slug = Str::slug($translation['name'], '-');

                    // Check for duplicate slug in the same language across all categories
                    $existingSlug = CategoryTranslation::where('language_id', $language_id)
                        ->where('slug', $slug)
                        ->first();

                    if ($existingSlug) {
                        return redirect()->back()->withInput()->with('error', ' "' . $slug . '" - ' . translate_key('slug_exists') ." ". translate_key('slug_exists_for_language'));
                    }

                    CategoryTranslation::create([
                        'category_id' => $category->id,
                        'language_id' => $language_id,
                        'name' => $translation['name'],
                        'slug' => $slug,
                        'description' => $translation['description'],
                    ]);
                }
            }

            return redirect()->route('categories.index')->with('success', translate_key('category_created_successfully'));

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'Database Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Unexpected Error: ' . $e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $languages = Language::getActiveLanguages();
        $categories = Category::all();
        $translations = $category->translations->keyBy('language_id');
        $locale = App::getLocale();
        return view('admin.categories.edit', compact('category', 'languages', 'categories', 'translations', 'locale'));
    }

    public function update(Request $request, Category $category)
    {
        try {
            $request->validate([
                'translations' => 'required|array',
                'translations.*.name' => 'nullable|string|max:255',
                'translations.*.slug' => 'nullable|string|max:255',
                'translations.*.description' => 'nullable|string',
            ]);

            $category->update([
                'parent_id' => $request->parent_id,
                'is_active' => $request->is_active,
            ]);

            foreach ($request->translations as $language_id => $translation) {
                if (!empty($translation['name'])) {
                    $slug = Str::slug($translation['name'], '-');

                    // Check for duplicate slug in the same language across all categories
                    $existingSlug = CategoryTranslation::where('language_id', $language_id)
                        ->where('slug', $slug)
                        ->where('category_id', '!=', $category->id)
                        ->first();

                    if ($existingSlug) {
                        return redirect()->back()->withInput()->with('error', 'The slug "' . $slug . '" already exists for this language. Please choose a different slug.');
                    }

                    CategoryTranslation::updateOrCreate(
                        [
                            'category_id' => $category->id,
                            'language_id' => $language_id
                        ],
                        [
                            'name' => $translation['name'],
                            'slug' => $slug,
                            'description' => $translation['description'],
                        ]
                    );
                }
            }

            return redirect()->route('categories.index')->with('success', translate_key('category_updated_successfully'));

        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'Database Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Unexpected Error: ' . $e->getMessage());
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', translate_key('category_deleted_successfully'));
    }
}