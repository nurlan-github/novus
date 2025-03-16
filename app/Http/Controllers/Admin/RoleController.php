<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Permissionlar bilan ruxsatni tekshirish
        $this->middleware('permission:show_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:edit_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['destroy']);
    }

    // Barcha rollarni ko'rish
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.roles.index', compact('roles'));
    }

    // Yangi role yaratish sahifasi
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    // Yangi role saqlash
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array', // Permission ID-lari massivi
        ]);

        // Avval role mavjudligini tekshirish
        if (Role::where('name', $request->name)->exists()) {
            return redirect()->route('roles.index')->with('error', "A role `{$request->name}` already exists for guard `web`.");
        }

        // Role-ni yaratish
        $role = Role::create(['name' => $request->name]);

        // Permissionlarni biriktirish
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name'); // Permission nomlarini olish
            $role->syncPermissions($permissions); // Permission nomlarini biriktirish
        }

        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    // Role-ni tahrirlash sahifasi
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    // Role-ni yangilash
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'nullable|array', // Permission ID-lari massivi
        ]);

        // Role nomini yangilash
        $role->update(['name' => $request->name]);

        // Permissionlarni biriktirish
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name'); // Permission nomlarini olish
            $role->syncPermissions($permissions); // Permission nomlarini biriktirish
        } else {
            $role->syncPermissions([]); // Agar permissionlar tanlanmagan bo'lsa, barchasini olib tashlash
        }

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }


    // Role-ni o'chirish
    public function destroy(Role $role)
    {

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
