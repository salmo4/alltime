<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the Message model
 * 
 * All Eloquent models extend Illuminate\Database\Eloquent\Model
 */
Class Message2 extends Model {

    /**
      The  messages table name  is explicitly specified
     */
    protected $table = 'messages2';


    /**
      The fillable property specifies which attributes should be mass-assignable.
     * 
      Mass assignment means you are filling a row with more than one column using an array of data.
     */
    protected $fillable = array('admin_id', 'email',  'message');

   

}
