<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Support\Str;

class PageController extends Controller
{

    private $pageRepository;

    public function __construct()
    {
        $this->pageRepository = app(PageRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageRepository->getAll();

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageStoreRequest $request)
    {
        $slug = Str::slug($request->slug);

        $page = Page::query()->create([
            'title' => $request->title,
            'text' => $request->text,
            'slug' => $slug,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);
        return redirect()->route('page.edit', [$page->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->getById($id);
        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
        $page = $this->pageRepository->getById($id);

        $slug = Str::slug($request->slug);

        if(Page::query()->where('slug', '=', $slug)->where('id', '!=', $id)->exists()) {
            $placeId = Page::query()->latest()->first()->id + 1;
            $slug .= '-'.$placeId;
        }
        $page->update([
            'title' => $request->title,
            'text' => $request->text,
            'slug' => $slug,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'menu' => $request->boolean('menu'),
        ]);
        return redirect()->route('page.edit', [$page->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::query()->find($id);
        $page->delete();

        return redirect()->route('page.index');
    }
}
