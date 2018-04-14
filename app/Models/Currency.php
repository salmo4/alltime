<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * The model is currency of the product
 */
Class Currency extends Model {

    /**
      The  currency table name  is explicitly specified
     */
    protected $table = 'currency';

    /**
      This method gets currency ful name
     */
    public function getCurrencyFullNameAttribute() {
        return ' [' . $this->attributes['code'] . ']  ' . $this->attributes['currency'] . ' ' . $this->attributes['country'];
    }

}