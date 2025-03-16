<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Permissionlar bilan ruxsatni tekshirish
        $this->middleware('permission:show_permissions')->only(['index']);
        $this->middleware('permission:create_permissions')->only(['create', 'store']);
        $this->middleware('permission:edit_permissions')->only(['edit', 'update']);
        $this->middleware('permission:delete_permissions')->only(['destroy']);
    }

    // Barcha permissionlarni ko'rish
    public function index()
    {
        // Permissionlarni oxirgi yaratilganlarini birinchi chiqarish
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.permissions.index', compact('permissions'));
    }

    // Yangi permission yaratish sahifasi
    public function create()
    {
        return view('admin.permissions.create');
    }

    // Yangi permission saqlash
    public function store(Request $request)
    {
        $request->validate([
            'resource_name' => 'required|string|max:255',
        ]);

        // Resource nomini olish
        $resourceName = strtolower($request->resource_name);

        // Generatsiya qilinadigan permissionlar
        $permissions = [
            "show_$resourceName",
            "create_$resourceName",
            "edit_$resourceName",
            "delete_$resourceName",
        ];

        $existingPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();

        foreach ($permissions as $permissionName) {
            if (in_array($permissionName, $existingPermissions)) {
                return redirect()->route('permissions.index')->with('error', "A '$resourceName' permission already exists for guard 'web'.");
            }

            Permission::create(['name' => $permissionName]);
        }

        // Admin roliga permissionlarni qo'shish
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }

        return redirect()->route('permissions.index')->with('success', 'Permissions generated successfully.');
    }

    // Permission-ni tahrirlash sahifasi
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    // Permission-ni yangilash
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Permission-ni o'chirish
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
