<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;

/**
  All controllers should extend the BaseController class.
 * The BaseController is also stored in the app/controllers directory, and may be used as a place to put shared controller logic. 
 * The BaseController extends the framework's Controller class.
 */
class BaseController extends Controller {

    /**
     * Setup the layout used by the controller.
     *
     */
    protected $layout = 'layout.main';
    protected $application_type = 1; //auction
    protected $application_name = ' ';

    // protected $layout = 'layout.test';

    /**
     * Instantiate a new BaseController instance.
     * Setting the default language
     */
    public function __construct() {

        $value = Session::get('lang');
        if (empty($value)) {
            \App::setLocale('en');
        } else {
            \App::setLocale($value);
        }

        if (\Config::get('database.application_setting.application_type') == 1) {
            $this->application_type = 1; // auction 
        } else {
            $this->application_type = 2; // webshop
        }

        $this->application_name = \Config::get('database.application_setting.application_name');
        // echo  $this->application_name;
    }

    /**
      Setting the layout
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = \View::make($this->layout);
            $this->layout->content = \View::share(array(
                        //   'application_type' => $this->application_type,
                        'application_type' => 2,
                        'application_name' => $this->application_name
            ));
            $content = array(
                 'application_type' => $this->application_type,
                'application_name' => $this->application_name
            );
            
          //  var_dump($content);
            return view($this->layout, ['content' => $content]);
        }
    }
    
    /*	public function callAction($method, $parameters)
	{
		
             $this->setupLayout();
            return call_user_func_array(array($this, $method), $parameters);
	}*/
    




}
