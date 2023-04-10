<?php

namespace App\Repositories;

use App\Models\Setting as Model;

class SettingRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = [
            'title', 'name', 'value',
        ];
        $result = $this->startConditions()->query()
            ->select($columns)
            ->where('name', '!=', 'phone_link')
            ->where('name', '!=', 'phone2_link')
            ->toBase()
            ->get();

        return $result;
    }
    public function getAllForUser()
    {
        $columns = [
            'name', 'value',
        ];
        $result = $this->startConditions()->query()
            ->select($columns)
            ->toBase()
            ->get()
            ->keyBy('name');

        return $result;
    }
}
