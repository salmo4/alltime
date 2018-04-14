<?php


use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class BidTest extends TestCase {

public function testBidAdd()
{
   
      $user = Auth::loginUsingId(5);

      $this->actingAs($user)
      ->visit('product/2')
              ->type('2', 'product')
              ->type('1650', 'price')
              ->press('Place Bid')
            ->see('Thank you for your bid.');

}
    
}
