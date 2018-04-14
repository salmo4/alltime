<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input ;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Http\Request;

class BasketController extends Controller {

    public function basketfull() {

       return \View::make('basket/basketfull');
    }

    public function superadminGetIndex() {


        $bid_products = DB::table('bids')
                ->select('bids.id as bidsid', 'fix_price_status', 'price', 'message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'owner.name as owner_name', 'currency')
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
                ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
                ->orderBy('bids.created_at', 'desc')
                ->get();

        $this->layout->content = View::make('bid/superadminindex')->with('bid_products', $bid_products);
    }



    public function basketGet() {

       // $this->layout = View::make('layout.null');


        $my_id = Auth::user()->id;


        $basket = DB::table('basket')
                ->select('bid','basket.id as basketid', 'quantity', 'products.shop_price AS price', 'basket.created_at as basket_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency')
                ->where('basket.member_id', '=', $my_id)
                //  ->where('basket.admin_id', '=', $admin_id)
                ->join('products', 'products.id', '=', 'basket.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'basket.member_id')
                ->join('users as owner', 'owner.id', '=', 'basket.admin_id')
                ->orderBy('basket.created_at', 'desc')
                ->get();
          
          echo json_encode($basket );
    }

    /**
      url: /basketitem
      admin method
      list item of basket
     */
    public function basketPost(Request $request) {

      //  $this->layout = View::make('layout.null');

         if ($request->isMethod('post')) {
            $idArr = Input::get('id');
            $quantityArr = Input::get('quantity');

            foreach ($idArr as $key => $id) {
                $update = \App\Models\Basket::find($id);
                $update->quantity = $quantityArr[$key];
                $update->save();
            }

            echo 'basket saved';
        }
    }

    /**
      When logged user adds bid
      Then letter was sent to the owner
     */
    public function add() {


                \App\Models\Basket::create(
                        array(
                            'member_id' => Input::get('member_id'),
                            'admin_id' => Input::get('admin_id'),
                            'product_id' => Input::get('product_id'),
                           // 'quantity' => Input::get('quantity'),
                            'quantity' => 1,
                            'bid' => Input::get('bid')
                ));

               // return Redirect::route('index')->with('message', 'The product is in the basket.');
                echo "The product is in the Bidder's basket.";
                
                
                
            
               $data = array();

                //$user = \App\Models\User::find(Auth::user()->id);
              
            $email = Input::get('email');
            
                         \Mail::send('emails.yourbidthewinning', $data, function($message) use ($email) {
                            $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                            $message->to($email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Online Laravel Auction - Congratulate! Your bid is the winner.');
                        });

    }

    /**
      The owner of products can delete bids
     */
    public function getDelete($id) {

        $member_id = Auth::user()->id;

        // $res = Bid::find($id)->delete();

        $res = \App\Models\Basket::whereRaw('id=' . $id . ' AND member_id=' . $member_id)->delete();

        return Redirect::route('basket/basketfull');
    }

}

