<?php

namespace App\Repositories;
use App\Models\Meta as Model;

class MetaRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = ['id', 'type', 'name', 'title'];
        $result = $this->startConditions()
            ->select($columns)
            ->toBase()
            ->get()
            ->groupBy('type');

        return $result;
    }
    public function getType()
    {
        $result = $this->startConditions()->query()
            ->distinct()
            ->toBase()
            ->get(['type']);

        return $result;
    }

    public function getAllByType($type)
    {
        $columns = ['id', 'name', 'title'];
        $result = $this->startConditions()->query()
            ->select($columns)
            ->where('type', '=', $type)
            ->toBase()
            ->get();

        return $result;
    }
    public function getBySlug($slug) {
        $columns = ['name', 'seo_title', 'seo_description',
            'big_title', 'small_title', 'text'];
        $result = $this->startConditions()->query()
            ->select($columns)
            ->where('slug', '=', $slug)
            ->toBase()
            ->first();

        return $result;
    }


    public function getById($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }

}
