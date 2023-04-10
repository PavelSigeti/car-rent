<?php

namespace App\Repositories;

use App\Models\CarPrice as Model;
use Carbon\Carbon;

class CarPriceRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getCarPricesById($id)
    {
        $columns = [
          'price', 'price2', 'price3',
          'start', 'end', 'id',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->where('car_id', $id)
            ->orderBy('start')
            ->toBase()
            ->get();

        foreach($result as $key => $value) {
            $start = Carbon::createFromFormat('Y-m-d H:i:s', $value->start)->format('Y-m-d\TH:i:s');
            $end = Carbon::createFromFormat('Y-m-d H:i:s', $value->end)->format('Y-m-d\TH:i:s');
            $result[$key]->start = $start;
            $result[$key]->end = $end;
        }

        return $result;
    }

    public function getCarPriceForUpdate($id)
    {
        $result = $this->startConditions()
            ->find($id);

        return $result;
    }
}
