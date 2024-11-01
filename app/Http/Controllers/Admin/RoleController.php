<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return Renderable|JsonResponse
     */
    public function index(Request $request)
    {
        $roles = Role::with(['permissions'])->withCount('users');

        $roles = app(Pipeline::class)
            ->send($roles)
            ->through([
                \App\QueryFilter\Search::class,
            ])
            ->thenReturn()
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if ($request->wantsJson()) {
            return response()->json(compact('roles'));
        }

        return view('admin.pages.roles.index', compact('roles'));
    }

    /**
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.pages.roles.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name',
            'short_label' => 'required|string|max:10',
            'permissions' => 'required|array',
        ]);
        $role_name = $request->only('name')['name'];
        $role = Role::create(['name' => $role_name,'guard_name' => 'user']);

        $role->givePermissionTo(Permission::whereIn('name', $data['permissions'])->where('guard_name', 'user')->get());
        session()->flash('success', __('messages.flash.create'));
        return redirect()->route('admin.pages.roles.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id): Renderable
    {
        $role = Role::findOrFail($id);
        $role->load(['permissions:id,name']);
        return view('admin.pages.roles.edit',compact('role'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:roles,name,' . $request->role,
            'short_label' => 'required|string|max:10',
            'permissions' => 'required|array',
        ]);

        $role = Role::findOrFail($id);
        $role->update($data);
        $role->syncPermissions(Permission::whereIn('name', $data['permissions'])->where('guard_name', 'user')->get());
        session()->flash('success', __('messages.flash.update'));
        return redirect()->back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        if($role->name === 'Admin')
        {
            throw ValidationException::withMessages(['error' => 'You cant delete the Admin role']);
        }

        $role->delete();
        session()->flash('success', __('messages.flash.delete'));
        return redirect()->route('admin.pages.roles.index');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPermissionsList(Request $request): JsonResponse
    {
        $permissions = Permission::orderBy('name')->select(['id', 'name'])->newQuery();
        if ($request->has('search') && !empty($request->get('search'))) {
            $permissions->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $permissions = $permissions->paginate(10);

        $permissions->getCollection()->transform(function ($permission) {
            $permission->name = Str::replace('-', ' ', $permission->name);
            return $permission;
        });

        return response()->json([
            'success' => true,
            'permissions' => $permissions
        ]);
    }
}
