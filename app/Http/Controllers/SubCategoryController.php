<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\SubCategoryInterface;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    private SubCategoryService $service;
    private SubCategoryInterface $subCategories;

    public function __construct(SubCategoryInterface $subCategories, SubCategoryService $service)
    {
        $this->subCategories = $subCategories;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        $subCategories = $this->subCategories->paginate($category);
        return view('pages.admin.categories.subcategories.index', compact('subCategories', 'category'));
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
    public function store(StoreSubCategoryRequest $request, Category $category)
    {
        $data = $this->service->storeOrUpdate($request);
        $data['category_id'] = $category->id;
        $this->subCategories->store($data);
        return redirect()->back()->with('success' , 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $categoryIds = $request->input('category_ids');
        $subCategory = $this->subCategories->where($categoryIds);
        return response()->json(['data' => $subCategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubCategoryRequest $request, SubCategory $subCategory)
    {
        $data = $this->service->storeOrUpdate($request);
        $this->subCategories->update($subCategory->id, $request->validated());
        return redirect()->back()->with('success' , 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $this->subCategories->delete($subCategory->id);
        return redirect()->back()->with('success' , 'Data berhasil di hapus');
    }
}
