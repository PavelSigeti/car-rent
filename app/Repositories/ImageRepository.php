<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Image as Model;

class ImageRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getImageByCarId($id) {
        $selectColumns = ['uri', 'type', 'group_id'];
        $whereInColumns = ['car_jpg', 'car'];
        $result = $this->startConditions()->query()
            ->where('object_id', '=', $id)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->toBase()
            ->get();
        $images = [];
        foreach ($result as $item) {
            $images[$item->group_id][$item->type] = $item->uri;
        }
        return $images;
    }

    public function getByCarId($id) {
        $selectColumns = ['uri', 'type', 'group_id', 'updated_at'];
        $whereInColumns = ['car_jpg', 'car', 'car_main', 'car_main_jpg'];
        $result = $this->startConditions()->query()
            ->where('object_id', '=', $id)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->get()->groupBy('group_id');

        return $result->toArray();
    }


    public function getMainImageByCarId($id) {
        $selectColumns = ['uri', 'type'];
        $whereInColumns = ['car_main', 'car_main_jpg'];
        $result = $this->startConditions()->query()
            ->where('object_id', '=', $id)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->toBase()
            ->get();
        $images = [];
        foreach ($result as $item) {
            $images[$item->type] = $item->uri;
        }
        return $images;
    }

    public function getPlaceImage($id) {
        $selectColumns = ['uri'];
        $whereInColumns = ['place'];
        $result = $this->startConditions()->query()
            ->where('object_id', '=', $id)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->toBase()
            ->first();

        return $result;
    }

    public function getPostImage($id) {
        $selectColumns = ['uri'];
        $whereInColumns = ['post'];
        $result = $this->startConditions()->query()
            ->where('object_id', '=', $id)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->toBase()
            ->first();

        return $result;
    }

    public function getThumbById($ids)
    {
        $selectColumns = ['uri','type', 'object_id', 'updated_at'];
        $whereInColumns = ['car_main_thumb', 'car_main_thumb_jpg'];
        $result = $this->startConditions()->query()
            ->whereIn('object_id', $ids)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->get()
            ->groupBy('object_id');

        return $result->toArray();
    }

    public function getPlaceById($ids)
    {
        $selectColumns = ['uri','type', 'object_id', 'updated_at'];
        $whereInColumns = ['place', 'place_webp', 'place_webp_sm'];
        $result = $this->startConditions()->query()
            ->whereIn('object_id', $ids)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->get()
            ->sortBy('type')
            ->groupBy('object_id');

        return $result->toArray();
    }

    public function getPostById($ids)
    {
        $selectColumns = ['uri','type', 'object_id', 'updated_at'];
        $whereInColumns = ['post', 'post_webp'];
        $result = $this->startConditions()->query()
            ->whereIn('object_id', $ids)
            ->whereIn('type', $whereInColumns)
            ->select($selectColumns)
            ->orderBy('object_id', 'desc')
            ->get()
            ->sortBy('type')
            ->groupBy('object_id');
        return $result->toArray();
    }

    public function getAllMainImages()
    {
        $selectColumns = ['uri', 'object_id'];
        $result = $this->startConditions()->query()
            ->where('type', 'car_main')
            ->select($selectColumns)
            ->toBase()
            ->get()
            ->keyBy('object_id');

        return $result;
    }

}
