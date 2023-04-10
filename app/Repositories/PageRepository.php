<?php

namespace App\Repositories;

use App\Models\Page as Model;

class PageRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = ['id', 'title'];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'desc')
            ->toBase()
            ->get();

        return $result;
    }

    public function getById($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }

    public function getBySlug($slug)
    {
        $result = $this->startConditions()->query()
            ->where('slug', $slug)
            ->first();

        return $result;
    }

}
