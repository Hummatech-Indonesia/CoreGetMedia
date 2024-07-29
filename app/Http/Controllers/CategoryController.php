<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryInterface $categories;
    private CategoryService $service;

    public function __construct(CategoryInterface $categories, CategoryService $service)
    {
        $this->categories = $categories;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = $this->categories->paginate($request);
        return view('pages.admin.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $this->service->storeOrUpdate($request);
        $this->categories->store($data);
        return redirect()->back()->with('success' , 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = $this->categories->get();
        return view('pages.user.category.index' , compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        // dd($category->id);
        $data = $this->service->storeOrUpdate($request);
        $this->categories->update($category->id , $data);
        return redirect()->back()->with('success' , 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->categories->delete($category->id);
        return redirect()->back()->with('success' , 'Data berhasil di hapus');
    }
}
