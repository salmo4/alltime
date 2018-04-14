<?php

//run: E:\server\UniServerZ_2015\www\projects\laravel5\auction_webshop>E:\server\UniServerZ_2015\www\projects\laravel5\auction_webshop\vendor\bin\phpunit

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductTest extends TestCase {

    //test product list
    public function testAllProductList() {
        $this->visit('/')
                ->click('List')
                ->seePageIs('/index');
    }

    //test user's product -public
    public function testOneProduct() {
        $this->visit('product/1')
                ->seePageIs('product/1');
    }

    //test one product
    public function testUserProductList() {
        $this->visit('index/30')
                ->seePageIs('index/30');
    }

    //admin product list
    public function testAdminProductList() {
        //5: Thomas user
        $user = Auth::loginUsingId(5);

        $this->actingAs($user)
                ->visit('product/adminproductlist')
                ->seePageIs('product/adminproductlist');
    }



    
}
