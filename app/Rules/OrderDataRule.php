<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OrderDataRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $dates = explode(' - ', $value);
        $startDate = \DateTime::createFromFormat('d.m.Y', $dates[0]);
        $endDate = \DateTime::createFromFormat('d.m.Y', $dates[1]);

        $dateDiff = $endDate->diff($startDate)->format("%a");

        return $startDate && $startDate->format('d.m.Y') === $dates[0]
            && $endDate && $endDate->format('d.m.Y') === $dates[1] && $dateDiff > 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Проверьте даты бронирования';
    }
}
