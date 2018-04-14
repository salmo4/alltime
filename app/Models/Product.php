<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the Poduct model
 * 
 * All Eloquent models extend Illuminate\Database\Eloquent\Model
 */
Class Product extends Model {

    /**
      The products table name  is explicitly specified
     */
    protected $table = 'products';
    


    /**
      The fillable property specifies which attributes should be mass-assignable.
     * 
     Mass assignment means you are filling a row with more than one column using an array of data. 
     * 
     */
    protected $fillable = array(
        'application_type',
        'title',
        'description',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'image7',
        'image8',
        'image9',
        'image10', 
        'fix_price_status',
        'shop_price',
        'opening_price',
        'lowest_price',
        'buynow_price',
        'currency_id',
        'category_id',
        'admin_id',
        'confirm',
        'timelimit'
    );

    /**
      Defining The Inverse Of A Relation  between Product and Category
     */
    public function Category() {

        return $this->belongsTo('Category');
    }

    /**
      Defining The Inverse Of A Relation  between Product and Currency
     */
    public function Currency() {

        return $this->belongsTo('Currency');
    }

    

    
    //Mutator
    /*
      public function setCoverAttribute($value) {
      if(!empty($value)){
      $this->attributes['cover'] = $value;
      }

      } */
}
