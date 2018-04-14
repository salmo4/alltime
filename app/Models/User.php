<?php

/**
 * This is the User model
 * 
 * It contains method of Authentication and Password Reminders
 */


// for User authentication - Laravel 4
//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//for Password Reminders & Reset
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;

//https://laravel.com/docs/5.2/eloquent-relationships

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Laravel 4
/*class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;*/

    class User extends Model{
    /**
      If the admin column is 2 the user is the main administrator
     */
    public function isSuperAdmin() {
        return $this->admin == 2;
    }

    /**
      The  users table name  is explicitly specified
     */
    protected $table = 'users';

    /**
      The fillable property specifies which attributes should be mass-assignable.
     */
    protected $fillable = array('email', 'password', 'name', 'admin', 'currency_id');

    /**
     * The hidden attributes excluded from the model's  form.
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
      This remember_token column of User will be used to store a token for "remember me" sessions being maintained by your application.
     */
    public function getRememberToken() {
        return $this->remember_token;
    }

    // set the remember_token from users table
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    
     /**
      * get the remember_token name from users table
      */
    public function getRememberTokenName() {
        return 'remember_token';
    }


      public function profiles() {
      return $this->hasMany('Profile');
      }
    

      /**
       * Mutator - create password from value
       */
    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    //event system rossz
    /*
      public static function boot() {
      parent::boot();

      static::creating(function($post) {
      $post->password = Hash::make($post->password );
      });

      static::updating(function($post) {
      $post->password = Hash::make($post->password );
      //   $post->password = $post->password ;
      });
      }
     */
}