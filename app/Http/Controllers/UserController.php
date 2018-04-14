<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Quotation;
use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller {

    /**
     * The method gets login form
     */
    public function getlogin() {

        return \View::make("user/login");
    }

    /**
      The method  authenticate user if user posts the login information
     * 
      The method redirects user to  the Administrator page if user is Superadmin admin
     */
    public function postLogin() {
        $email = Input::get('email');
        $password = Input::get('password');

        if (Auth::attempt(array('email' => $email, 'password' => $password))) {

            if (Auth::user()->admin == 2) {

                //  return Redirect::route('superadmin_area');
                return Redirect::intended('superadminarea');
            } else {
                // return Redirect::route('index');
                /*
                  The Redirect::intended function will redirect the user to the URL they were trying to access before being caught by the authentication filter. A fallback URI may be given to this method in case the intended destination is not available.
                 */

                $application_type = session()->get('application_type'); //echo $application_type;
                if (empty($application_type)) {
                    return Redirect::intended('index');
                } else {
                    return Redirect::to('/index/' . $application_type);
                }
            }
        } else {

            return Redirect::route('index')
                            ->with('error', trans('c.Please check your password & email'));
        }
    }

    //news
    public function news() {
        return \View::make("user/news");
    }

    //about
    public function about() {
        return \View::make('about');
    }

    /**
     * The method logouts user.
     */
    public function getLogout() {
        Auth::logout();
        return Redirect::route('index');
    }

    /**
     * The method gets user create  form
     */
    public function create() {
        return \View::make('user.create');
    }

    /**
     * The method stores a newly created user in the database if the user data was valid.
     */
    public function store() {

        //username, email, password validation unique

        $data = Input::all();
        // var_dump($data); return View::make('hello');
        $validator = Validator::make($data, array('name' => 'unique:users'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.This Username exists!'))->withInput();
        }
        $validator = Validator::make($data, array('name' => 'required'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.The Username is empty!'))->withInput();
        }


        $validator = Validator::make($data, array('email' => 'unique:users'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.This Email exists!'))->withInput();
        }
        $validator = Validator::make($data, array('email' => 'required'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.The Email is empty!'))->withInput();
        }

        $validator = Validator::make($data, array('email' => 'email'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.The Email address is not valid!'))->withInput();
        }


        $validator = Validator::make($data, array('password' => 'required'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.The Password is empty!'))->withInput();
        }

        $validator = Validator::make($data, array('password_confirmation' => 'required'));
        if ($validator->fails()) {
            return Redirect::to('/user/create')->with('error', trans('c.The Password confirmation is empty!'))->withInput();
        }



        if (Input::get('password') == Input::get('password_confirmation')) {
            $user = new \App\Models\User;
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            //$user->password = Hash::make(Input::get('password'));
            // user-ben van egy elkodolo
            $user->password = Input::get('password');
            $user->admin = 1;

            $user->save();

            //sending email message

            $data = array(
                'email' => Input::get('email'),
            );



            \Mail::send('emails.registration', $data, function($message) {
                $message->from('samy.gui95@gmail.com', 'Site Admin');
                $message->to(Input::get('email'), Input::get('name'))->subject(trans('c.Welcome to our Online Auction site'));
            });
            ///

            return Redirect::to('/')->with('message', trans('c.Your account have been created.'))->withInput();
        } else {
            return Redirect::to('/user/create')->with('error', trans('c.Password confirmation doesnt match Password.'))->withInput();
        }
    }

    /**
     * The method gets user edit form
     * The method stores a newly created user in the database if the user data was valid.
     */
    public function edit() {
        $id = Auth::user()->id;


        if ($this->isPostRequest()) {



            if (Auth::user()->email == 'samy.gui95@gmail.com') {
                return Redirect::route('index')
                                ->with('message', 'You are not allowed to change Test account. Plese create own registration. Thank you! ');
            } else if (Input::get('onlycurrency') == 1) {
                $user = \App\Models\User::find($id);
                $user->currency_id = Input::get('currency_id');
                $user->save();
            } else {

                $data = Input::all();

                $validator = Validator::make($data, array('name' => 'unique:users'));

                $validator = Validator::make($data, array('name' => 'required'));
                if ($validator->fails()) {
                    return Redirect::to('/user/edit')->with('error', trans('c.The Username is empty!'))->withInput();
                }



                $validator = Validator::make($data, array('email' => 'required'));
                if ($validator->fails()) {
                    return Redirect::to('/user/edit')->with('error', trans('c.The Email is empty!'))->withInput();
                }

                $validator = Validator::make($data, array('email' => 'email'));
                if ($validator->fails()) {
                    return Redirect::to('/user/edit')->with('error', trans('c.The Email address is not valid!'))->withInput();
                }


                $validator = Validator::make($data, array('password' => 'required'));
                if ($validator->fails()) {
                    return Redirect::to('/user/edit')->with('error', trans('c.The Password is empty!'))->withInput();
                }

                $validator = Validator::make($data, array('password_confirmation' => 'required'));
                if ($validator->fails()) {
                    return Redirect::to('/user/edit')->with('error', trans('c.The Password confirmation is empty!'))->withInput();
                }




                if (Input::get('password') == Input::get('password_confirmation')) {

                    $user = \App\Models\User::find($id);
                    $user->name = Input::get('name');
                    $user->email = Input::get('email');

                    $user->password = Input::get('password');
                    $user->currency_id = Input::get('currency_id');
                    $user->save();

                    return Redirect::route('index')
                                    ->with('message', 'The user data has been changed successfully.');
                } else {

                    return Redirect::to('/user/edit')->with('error', trans('c.Password confirmation doesnt match Password.'))->withInput();
                }
            }
        }

        //  echo Auth::user()->email;

        $currency_list = \App\Models\Currency::orderBy('code')->get()->lists('CurrencyFullName', 'id');

        //var_dump($currency_list);

        return \View::make('user/useredit', array('currency_list' => $currency_list))->with('user', \App\Models\User::find($id));
    }

    /**
      The utility method checks that the Input is Post format
     */
    protected function isPostRequest() {
        return Input::server("REQUEST_METHOD") == "POST";
    }




    public function test() {
        //echo Hash::make('hello');
        //return View::make('hello');

        $laravel = app();
        echo $version = $laravel::VERSION;
    }

}
