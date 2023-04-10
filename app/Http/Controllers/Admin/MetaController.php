<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MetaStoreRequest;
use App\Http\Requests\MetaUpdateRequest;
use App\Models\Meta;
use App\Repositories\MetaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MetaController extends Controller
{

    private $metaRepository;

    public function __construct()
    {
        $this->metaRepository = app(MetaRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metasType = $this->metaRepository->getType();

        return view('admin.meta.index', compact('metasType'));
    }

    public function type($type)
    {
        $metas = $this->metaRepository->getAllByType($type);

        return view('admin.meta.type', compact('metas', 'type'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetaStoreRequest $request)
    {
        $title = Meta::query()->select('title')
            ->where('type', '=', $request->type)
            ->first()->title;

        $slug = Str::slug($request->name);
        Meta::query()->create([
            'type' => $request->type,
            'title' => $title,
            'name' => $request->name,
            'slug' => $slug,
            'seo_title' => $request->name,
            'seo_description' => $request->name,
            'big_title' => $request->name,
            'small_title' => $request->name,
        ]);
        return redirect()->route('meta.type', [$request->type]);
    }

    public function storeNew($request) {

        $slug = Str::slug($request->name);
        Meta::query()->create([
            'type' => $request->type,
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect()->route('meta.type', [$request->type]);
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
        $meta = $this->metaRepository->getById($id);

        return view('admin.meta.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MetaUpdateRequest $request, $id)
    {
        $meta = $this->metaRepository->getById($id);

        if(!isset($meta)) {
            return abort(404);
        }

        $meta->update([
            'name' => $request->name,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'big_title' => $request->big_title,
            'small_title' => $request->small_title,
            'text' => $request->text,
        ]);
        return redirect()->route('meta.edit', [$meta->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meta = $this->metaRepository->getById($id);
        $type = $meta->type;
        $meta->delete();

        return redirect()->route('meta.type', [$type]);
    }
}
