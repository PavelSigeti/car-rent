<?php

namespace App\Rules;

use App\Models\CarPrice;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class CarPriceDateOverlapRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($carId, $from, $to)
    {
        $this->carId = $carId;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $carId = $this->carId;
        $from = $this->from;
        $to = $this->to;

        $fromCarbon = Carbon::parse($from);
        $toCarbon = Carbon::parse($to);



        if($fromCarbon->year !== 2020 && $toCarbon->year !== 2020) {
            return false;
        }

        $checkFrom = Carbon::create(2020,12, 25);
        $checkTo = Carbon::create(2020,12, 31, 23, 59, 59);
        $checkFromStart = Carbon::create(2020,1, 1);
        $checkToStart = Carbon::create(2020,1, 10, 23, 59, 59);

        if($fromCarbon->between($checkFrom, $checkTo)
            || $toCarbon->between($checkFrom, $checkTo)
            || $fromCarbon->between($checkFromStart, $checkToStart)
            || $toCarbon->between($checkFromStart, $checkToStart)
        ) {
            return false;
        }

        $check = CarPrice::query()->where('car_id', '=', $carId)
            ->whereBetween('start', [$from, $to])

            ->orWhere('car_id', '=', $carId)
            ->whereBetween('end', [$from, $to])

            ->orWhere('car_id', '=', $carId)
            ->where('start', '<=', $from)
            ->where('end', '>=', $from)

            ->orWhere('car_id', '=', $carId)
            ->where('start', '<=', $to)
            ->where('end', '>=', $to)
            ->count();
        return $check == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ошибка в датах, возможно пересечение';
    }
}
