<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * This is the Message model
 * 
 * All Eloquent models extend Illuminate\Database\Eloquent\Model
 */
Class Message extends Model {

    /**
      The  messages table name  is explicitly specified
     */
    protected $table = 'messages';


    /**
      The fillable property specifies which attributes should be mass-assignable.
     * 
      Mass assignment means you are filling a row with more than one column using an array of data.
     */
    protected $fillable = array('bid_id', 'sender_id', 'recipient_id',  'message');

    /**
      Defining The Inverse Of A Relation  between Message and Bid
     */
    public function Bid() {

        return $this->belongsTo('Bid', 'bid_id');
    }

    /**
      Defining The Inverse Of A Relation  between Message and User
     */
    public function Sender() {

        return $this->belongsTo('\App\Models\User', 'sender_id');
    }

    /**
      Defining The Inverse Of A Relation  between Bid and Owner
     */
    public function Recipient() {

        return $this->belongsTo('User', 'recipient_id');
    }



}
