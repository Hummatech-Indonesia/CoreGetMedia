<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TagInterface;
use App\Models\Tags;
use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Services\TagsService;

class TagsController extends Controller
{
    private TagInterface $tags;
    private TagsService $tagservice;

    public function __construct(TagInterface $tags, TagsService $tagservice)
    {
        $this->tags = $tags;
        $this->tagservice = $tagservice;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tags->paginate();
        return view('pages.admin.tag.index', compact('tags'));
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
    public function store(StoreTagsRequest $request)
    {
        $data = $this->tagservice->storeOrUpdate($request);
        $this->tags->store($data);
        return back()->with('success' , 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tags $tags)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTagsRequest $request, Tags $tags)
    {
        $data = $this->tagservice->storeOrUpdate($request);
        $this->tags->update($tags->id, $data);
        return back()->with('success' , 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tags)
    {
        $this->tags->delete($tags->id);
        return back()->with('success' , 'Data berhasil di hapus');
    }
}
