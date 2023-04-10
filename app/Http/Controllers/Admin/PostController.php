<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Repositories\ImageRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $postRepository;
    private $imageRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepository::class);
        $this->imageRepository = app(ImageRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->getAll();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $slug = Str::slug($request->slug);

        $post = Post::query()->create([
            'title' => $request->title,
            'text' => $request->text,
            'slug' => $slug,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);
        return redirect()->route('page.edit', [$post->id]);
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
        $post = $this->postRepository->getById($id);
        $image = $this->imageRepository->getPostImage($id);

        return view('admin.post.edit', compact('post', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->postRepository->getById($id);
        $slug = Str::slug($request->slug);

        if(Post::query()->where('slug', '=', $slug)->where('id', '!=', $id)->exists()) {
            $placeId = Post::query()->latest()->first()->id + 1;
            $slug .= '-'.$placeId;
        }
        $post->update([
            'title' => $request->title,
            'text' => $request->text,
            'slug' => $slug,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);
        return redirect()->route('post.edit', [$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::query()->find($id);
        $post->delete();

        return redirect()->route('post.index');
    }
}
