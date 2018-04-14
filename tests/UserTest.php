<?php

//run: E:\server\UniServerZ_2015\www\projects\laravel5\auction_webshop>E:\server\UniServerZ_2015\www\projects\laravel5\auction_webshop\vendor\bin\phpunit

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class UserTest extends TestCase 
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    
 /* public function testExample()
    {
        $this->assertTrue(true);
    }*/
    
    
    
    //take care the rountes.php definition /routes.php -ban leírtakat kell nézni
     
    //version test
  /*  public function testBasicExample()
    {
        $this->visit('laravel-version')
             ->see('Your Laravel version is 5.2.39');
                
    }*/
    
    

    
    
    //test login
    public function testUserLogin()
{
    $this->visit('user/login')
         ->type('samy.gui95@gmail.com', 'email')
         ->type('666', 'password')
         ->press('Sign In')
         ->seePageIs('/index')
            ;
}

//test login with session

    public function testAuth()
{

        //Auth::loginUsingId -here mentioned - http://stackoverflow.com/questions/37496939/testing-unauthorized-user-restriction-in-laravel-phpunit
        $user = Auth::loginUsingId(5);

        $this->actingAs($user)
             ->visit('/')
             ->see('Salmo');
}





}
