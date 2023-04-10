<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ImageRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\PostRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    private $settingRepository;
    private $placeRepository;
    private $imageRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepository::class);
        $this->settingRepository = app(SettingRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
        $this->imageRepository = app(ImageRepository::class);
    }

    public function index()
    {
        $posts = $this->postRepository->getWithPagination();

        $links = $posts->onEachSide(0)->links();
        $posts = $posts->keyBy('id')->toArray();
        $postImages = $this->imageRepository->getPostById(array_keys($posts));

        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('user.post.index', compact('posts', 'settings', 'places',
        'postImages', 'links'));
    }

    public function show($slug)
    {
        $post = $this->postRepository->getBySlug($slug);
        if($post == null) {
            abort(404);
        }
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('user.post.show', compact('post', 'settings', 'places'));
    }
}
