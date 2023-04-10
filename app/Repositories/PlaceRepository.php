<?php

namespace App\Repositories;

use App\Models\Place as Model;

class PlaceRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $colums = ['name', 'id', 'delivery_price', 'extra_price', 'slug', 'title'];
        $result = $this->startConditions()
            ->select($colums)
            ->get();

        return $result;
    }

    public function getAllLinks() {
        $colums = ['name', 'id', 'slug','title'];
        $result = $this->startConditions()
            ->select($colums)
            ->get()
            ->keyBy('id')
            ->toArray();

        return $result;
    }

    public function getById($id)
    {
        $colums = ['name', 'title', 'delivery_price', 'extra_price',
            'small_text', 'big_text', 'seo_title', 'seo_description',
            'slug', 'id', 'min_days', 'min_days_price'];
        $result = $this->startConditions()
            ->select($colums)
            ->find($id);

        return $result;
    }

    public function getNameById($id)
    {
        $colums = ['name'];
        $result = $this->startConditions()
            ->select($colums)
            ->toBase()
            ->find($id);

        return $result;
    }

    public function getPlaceData()
    {
        $columns = ['id', 'name', 'delivery_price', 'extra_price', 'min_days', 'min_days_price'];
        $result = $this->startConditions()
            ->select($columns)
            ->get()
            ->keyBy('id');

        return $result;
    }

    public function getBySlug($slug)
    {
        $columns = ['id', 'name', 'seo_title', 'slug',
            'seo_description', 'big_text', 'title'];
        $result = $this->startConditions()
            ->select($columns)
            ->where('slug', $slug)
            ->toBase()
            ->first();

        return $result;
    }

}
