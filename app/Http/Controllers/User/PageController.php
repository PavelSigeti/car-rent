<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\PageRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $settingRepository;
    private $placeRepository;
    private $pageRepository;

    public function __construct()
    {
        $this->settingRepository = app(SettingRepository::class);
        $this->placeRepository = app(PlaceRepository::class);
        $this->pageRepository = app(PageRepository::class);
    }

    public function uslovia() {
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('uslovia', compact('settings', 'places'));
    }

    public function contacts() {
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('contacts', compact('settings', 'places'));
    }

    public function about()
    {
        $settings = $this->settingRepository->getAllForUser();
        $places = $this->placeRepository->getAllLinks();

        return view('about', compact('settings', 'places'));
    }

    public function show($slug)
    {
        $page = $this->pageRepository->getBySlug($slug);
        if($page == null) {
            abort(404);
        }


    }
}
