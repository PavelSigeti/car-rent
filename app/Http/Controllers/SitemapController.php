<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Meta;
use App\Models\Page;
use App\Models\Place;
use App\Models\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $car = Car::query()->orderBy('updated_at', 'desc')->first();
        $meta = Meta::query()->orderBy('updated_at', 'desc')->first();
        $place = Place::query()->orderBy('updated_at', 'desc')->first();
        $post = Post::query()->orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'cars' => $car,
            'metas' => $meta,
            'places' => $place,
            'posts' => $post,
        ])->header('Content-Type', 'text/xml');
    }

    public function cars()
    {
        $cars = Car::query()->where('is_published', '=', 1)->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.cars', compact('cars'))->header('Content-Type', 'text/xml');
    }

    public function metas()
    {
        $metas = Meta::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.metas', compact('metas'))->header('Content-Type', 'text/xml');
    }
    public function pages()
    {
        $pages = Page::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.pages', compact('pages'))->header('Content-Type', 'text/xml');
    }
    public function places()
    {
        $places = Place::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.places', compact('places'))->header('Content-Type', 'text/xml');
    }
    public function posts()
    {
        $posts = Post::query()->orderBy('updated_at', 'desc')->get();
        return response()->view('sitemap.posts', compact('posts'))->header('Content-Type', 'text/xml');
    }

}
