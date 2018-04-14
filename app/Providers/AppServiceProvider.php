<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    
       view()->composer('*', function ($view) 
    {

        $application_type = session()->get('application_type'); // echo 'application_type: '.   $application_type .' | ';
        $applocale = session()->get('applocale');
         $view->with(
                 array(
                    'application_type'=>  $application_type  ,
                    'application_name' => \Config::get('database.application_setting.application_name'),
                    'applocale'=>  $applocale,
                 )
                 
                 
                 );    
    });    
 
     /*   \View::share(array(

                'application_name' => \Config::get('database.application_setting.application_name')        
            ));*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
