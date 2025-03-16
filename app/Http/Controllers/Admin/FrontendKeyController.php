<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendKey;
use Illuminate\Http\Request;

class FrontendKeyController extends Controller
{
    public function index()
    {
        return response()->json(FrontendKey::all());
    }

    public function store(Request $request)
    {
        $request->validate(['key' => 'required|unique:frontend_keys']);
        $frontendKey = FrontendKey::create(['key' => $request->key]);
        return response()->json($frontendKey, 201);
    }

    public function destroy(FrontendKey $frontendKey)
    {
        $frontendKey->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
