<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Gadget;
use App\Product;

class SerialNumber implements Rule
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
        $in_gadget = (bool)Gadget::where('product_number', $value)->first();
        $in_product = (bool)Product::where('serial_number', $value)->first();
        return !$in_gadget && $in_product;
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Серійний номер не дійсний.';
    }
}
