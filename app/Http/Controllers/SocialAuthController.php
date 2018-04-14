<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use Redirect;

class SocialAuthController extends Controller
{
    
        public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

   /* public function callback()
    {
        // when facebook call us a with token
        $providerUser = \Socialite::driver('facebook')->user();
    }*/
    
        public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

      //  return redirect()->to('/index');
        
            $application_type = session()->get('application_type'); //echo $application_type;
           if(empty($application_type)){
                  return Redirect::intended('index');  
                }else{
                 return Redirect::to('/index/'.$application_type);     
            }
    }
    
    
}
