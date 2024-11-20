<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\NewsLetterContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsLetterRequest;
use App\Http\Requests\UpdateNewsLetterRequest;
use Inertia\Inertia;

class
NewsLetterController extends Controller
{
    /**
     * @var NewsLetterContract
     */
    protected NewsLetterContract $newsletter;

    /**
     * @param NewsLetterContract $newsletter
     */
    public function __construct(NewsLetterContract $newsletter)
    {
        $this->newsletter = $newsletter;

//        $this->middleware(['permission:view-list-newsletter'])->only(['index']);
//        $this->middleware(['permission:view-newsletter'])->only(['show']);
//        $this->middleware(['permission:edit-newsletter'])->only(['edit', 'update']);
//        $this->middleware(['permission:create-newsletter'])->only(['create', 'store']);
//        $this->middleware(['permission:delete-newsletter'])->only(['destroy']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsletters = $this->newsletter->findByFilter();
        return Inertia::render('newsletters/index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('newsletters/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsLetterRequest $request)
    {
        $this->newsletter->new($request->validated());
        return redirect()->route('admin.newsletters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $newsletter = $this->newsletter->findOneById($id);
        return Inertia::render('newsletters/show',compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $newsletter = $this->newsletter->findOneById($id);
        return Inertia::render('newsletters/edit',compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsLetterRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->newsletter->update($id, $request->validated());
        return redirect()->route('admin.newsletters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->newsletter->destroy($id);
        session()->flash('success',__('messages.flash.delete'));
        return redirect()->route('admin.newsletters.index');
    }
}
