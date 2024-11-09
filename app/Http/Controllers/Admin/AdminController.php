<?php

namespace app\Http\Controllers\Admin;

use App\Contracts\AdminContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * @var AdminContract
     */
    protected AdminContract $admin;

    /**
     * @param AdminContract $admin
     */
    public function __construct(AdminContract $admin)
    {
        $this->admin = $admin;

//        $this->middleware(['permission:view-list-admin'])->only(['index']);
//        $this->middleware(['permission:view-admin'])->only(['show']);
//        $this->middleware(['permission:edit-admin'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-admin'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-admin'])->only(['destroy']);
    }
    public function index()
    {
        $admins = $this->admin->setRelations(['roles'])->findByFilter();
        $canCreateAdmin = auth()->user()->can('create-admin');
        $canEditAdmin = auth()->user()->can('edit-admin');
        $canDeleteAdmin = auth()->user()->can('delete-admin');
        return Inertia::render('admins/index', [
            'admins' => $admins,
            'canCreateAdmin' => $canCreateAdmin,
            'canEditAdmin' => $canEditAdmin,
            'canDeleteAdmin' => $canDeleteAdmin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return Inertia::render('admins/create', [
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
       $admin = $this->admin->new($request->validated());
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = $this->admin->setRelations(['roles'])->findOneById($id);
        $roles = Role::all();
        return Inertia::render('admins/edit',compact('admin','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateAdminRequest $request)
    {
        $admin = $this->admin->update($id, $request->validated());
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->admin->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.admins.index');
    }
}
