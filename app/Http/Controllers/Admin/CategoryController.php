<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * @var CategoryContract
     */
    protected CategoryContract $category;

    /**
     * @param CategoryContract $category
     */
    public function __construct(CategoryContract $category)
    {
        $this->category = $category;

//        $this->middleware(['permission:view-list-category'])->only(['index']);
//        $this->middleware(['permission:view-category'])->only(['show']);
//        $this->middleware(['permission:edit-category'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-category'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-category'])->only(['destroy']);
    }
    public function index()
    {
        $categories = $this->category->findByFilter();
        return Inertia::render('categories/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->category->new($data);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->category->findOneById($id);
        return view('admin.pages.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->category->findOneById($id);
        return Inertia::render('categories/edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateCategoryRequest $request)
    {
        $category = $this->category->update($id,$request->validated());
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->category->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.categories.index');
    }
}
