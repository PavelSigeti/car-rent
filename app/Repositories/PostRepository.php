<?php

namespace App\Repositories;

use App\Models\Post as Model;

class PostRepository extends CoreRepository
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

    public function getLatest()
    {
        $columns = ['id', 'title', 'slug', 'created_at'];
        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->keyBy('id')
            ->toArray();

        return $result;
    }

    public function getBySlug($slug)
    {
        $result = $this->startConditions()->query()
            ->where('slug', $slug)
            ->first();

        return $result;
    }
    public function getWithPagination()
    {
        $columns = ['id', 'title', 'slug', 'created_at'];
        $result = $this->startConditions()
            ->query()
            ->select($columns)
            ->orderBy('created_at')
            ->paginate(30);

        return $result;
    }
}
