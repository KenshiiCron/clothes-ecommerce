<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * @var UserContract
     */
    protected UserContract $user;

    /**
     * @param UserContract $user
     */
    public function __construct(UserContract $user)
    {
        $this->user = $user;

//        $this->middleware(['permission:view-list-user'])->only(['index']);
//        $this->middleware(['permission:view-user'])->only(['show']);
//        $this->middleware(['permission:edit-user'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-user'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-user'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $users = $this->user->setRelations(['orders', 'wishlist'])->findByFilter();
        return Inertia::render('users/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = $this->user->new($request->validated());

        session()->flash('toast', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => __('messages.flash.update',['resource'=>'product']),
        ]);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): \Inertia\Response
    {
        $user = $this->user->setRelations(['orders', 'wishlist'])->findOneById($id);
        return Inertia::render('users/show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): \Inertia\Response
    {
        $user = $this->user->findOneById($id);
        return Inertia::render('users/edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->user->update($id, $request->validated());
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->user->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.users.index');
    }
}
