<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * The model is category of the product
 */
Class Category extends Model {

    /**
      The  category table name  is explicitly specified
     */
    protected $table = 'category';

    /**
      The fillable property specifies which attributes should be mass-assignable.
     */
    protected $fillable = array('name', 'picture');

    /**
      This method gets category by id
     */
    public function getCategory($id) {
        return $this->where('id', '=', $id)->get();
    }

    /**
      This static method gets the count of the category
     */
    public static function getCategoryCount() {
        return Category:: count();
    }

}