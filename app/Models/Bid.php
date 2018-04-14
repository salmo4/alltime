<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the Bid model
 * 
 * All Eloquent models extend Illuminate\Database\Eloquent\Model
 */
Class Bid extends Model {

    /**
      The  bids table name  is explicitly specified
     */
    protected $table = 'bids';

    /**
      The fillable property specifies which attributes should be mass-assignable.
     * 
      Mass assignment means you are filling a row with more than one column using an array of data.
     */
    protected $fillable = array('member_id', 'admin_id', 'product_id', 'price', 'message');

    /**
      Defining The Inverse Of A Relation  between Bid and Product
     */
    public function Product() {

        return $this->belongsTo('Product', 'product_id');
    }

    /**
      Defining The Inverse Of A Relation  between Bid and User
     */
    public function User() {

        return $this->belongsTo('User', 'member_id');
    }

    /**
      Defining The Inverse Of A Relation  between Bid and Owner
     */
    public function Owner() {

        return $this->belongsTo('User', 'admin_id');
    }

    /*
      public static function Test($id) {

      echo " Hello $id";
      }
     */

    /**
      This method gets the best bid of the product
     */
    public function scopeBestbid($query, $product_id) {
        return $query->where('product_id', '=', $product_id)->max('price');
    }

}
