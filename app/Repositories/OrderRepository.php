<?php

namespace App\Repositories;

use App\Models\Order as Model;

class OrderRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getPaginate($count)
    {
        $result = $this->startConditions()->query()
            ->orderBy('id', 'DESC')
            ->paginate($count);

        return $result;
    }

    public function getById($id)
    {
        $result = $this->startConditions()->query()
            ->find($id);

        return $result;
    }

    public function getLast()
    {
        $result = $this->startConditions()->query()
            ->last();
    }
}
