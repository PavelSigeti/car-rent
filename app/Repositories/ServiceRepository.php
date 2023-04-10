<?php

namespace App\Repositories;

use App\Models\Service as Model;

class ServiceRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        $columns = [
            'id', 'name', 'price',
        ];
        $result = $this->startConditions()
            ->select($columns)
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

    public function getTotalPriceFromArray($arr)
    {
        if($arr !== null) {
            $result = $this->startConditions()
                ->whereIn('id', array_keys($arr))
                ->sum('price');
        }
        else {
            $result = null;
        }


        return $result;
    }
}
