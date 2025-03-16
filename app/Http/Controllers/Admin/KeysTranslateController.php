<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendKey;
use App\Models\KeysTranslate;
use Illuminate\Http\Request;

class KeysTranslateController extends Controller
{
    public function index()
    {
        return response()->json(KeysTranslate::with(['frontendKey', 'language'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'frontend_key_id' => 'required|exists:frontend_keys,id',
            'language_id' => 'required|exists:languages,id',
            'value' => 'required'
        ]);

        $translate = KeysTranslate::create($request->all());
        return response()->json($translate, 201);
    }

    public function destroy(KeysTranslate $keysTranslate)
    {
        $keysTranslate->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
