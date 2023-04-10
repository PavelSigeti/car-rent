<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use App\Repositories\SettingRepository;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct()
    {
        $this->settingRepository = app(SettingRepository::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = $this->settingRepository->getAll();

        return view('admin.setting.index', compact('settings'));
    }

    public function updateAll(SettingUpdateRequest $request)
    {

        $phoneLink = preg_replace('/[^\+\d]/', '', $request->phone);
        $phone2Link = preg_replace('/[^\+\d]/', '', $request->phone2);

        foreach ($request->request as $key => $item) {
            Setting::query()->where('name', '=', $key)->update([
                'value' => $item,
            ]);
        }

        Setting::query()->where('name', '=' ,'phone_link')
            ->update([
                'value' => $phoneLink,
            ]);

        Setting::query()->where('name', '=' ,'phone2_link')
            ->update([
                'value' => $phone2Link,
            ]);


        return redirect()->route('setting.index');
    }

}
