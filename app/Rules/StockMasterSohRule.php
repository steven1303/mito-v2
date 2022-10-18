<?php

namespace App\Rules;

use App\Models\StockMaster;
use Illuminate\Contracts\Validation\Rule;

class StockMasterSohRule implements Rule
{
    protected $stock_master;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($stock_master)
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
        $stock_soh = StockMaster::soh()->where(['id','=', $this->stock_master])->soh;

        if($stock_soh >= $value){
            return true;
        }
        return false
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Qty SOH is not enough';
    }
}
