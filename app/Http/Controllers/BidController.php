<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Support\Facades\Input ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
/**
 * This controller contains the methods of the bid actions
 */
class BidController extends Controller {
    /**
      url: /mainbids
      list the arrived bids
     */
    public function mainIndex() {
        $admin_id = Auth::user()->id;

        $main_bid_products = DB::table('bids')
                ->select( 'products.id as product_id', 'fix_price_status', 'buynow_price',  'title', 'image1','currency', DB::raw(" MAX(price) AS maxbidprice"),  DB::raw(" COUNT(products.id) AS bids_count"), 'opened')
                //->distinct()
                ->where('bids.admin_id', '=', $admin_id)
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                 ->groupBy('products.id')
                ->orderBy('products.title', 'asc')
                ->get();
         //$queries = DB::getQueryLog();
         //$last_query = end($queries);
         //var_dump($last_query);
       // var_dump($main_bid_products);
        
        return \View::make('bid/mainindex')->with('main_bid_products', $main_bid_products);
    }
    
    
    
        /**
      list the sent bids
     */
    public function mainSent() {
        $admin_id = Auth::user()->id;

        $main_bid_products = DB::table('bids')
                ->select( 'products.id as product_id', 'fix_price_status',  'buynow_price', 'title', 'image1','currency', DB::raw(" MAX(price) AS maxbidprice"), DB::raw(" COUNT(products.id) AS bids_count"))
                //->distinct()
                ->where('bids.member_id', '=', $admin_id)
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                 ->groupBy('products.id')
                ->orderBy('products.title', 'asc')
                ->get();
        
       return \View::make('bid/mainsent')->with('main_bid_products', $main_bid_products);
    }
    
    
    
    


    /**
      url: /bids
      admin method
      list the arrived bids by product
     */
    public function arrivedBids($product_id) {

        $admin_id = Auth::user()->id;



        $bid_products = DB::table('bids')
                ->select('bids.member_id as member_id', 'bids.admin_id as admin_id','bids.id as bidsid', 'products.id as product_id','fix_price_status', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')
                ->where('bids.admin_id', '=', $admin_id)
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
                ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
                // ->leftJoin('messages', 'messages.bid_id', '=', 'bids.id')
                ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function($join) {
                            $join->on('bids.id', '=', 'ResultMessage.bid_id');
                        })
                        
                ->where('products.id', '=', $product_id)
                ->orderBy('bids.created_at', 'desc')
                ->get();


        //  $queries = DB::getQueryLog();
        //  $last_query = end($queries);
        //  var_dump($last_query);
        // var_dump($bid_products);
          return   \View::make('bid/arrived_bids')->with('bid_products', $bid_products);
    }
    
    
    
    /**
      url: /sentbids
      admin method
      list the sent bids by product
     */
    public function sentBids($product_id) {

        $admin_id = Auth::user()->id;



        $bid_products = DB::table('bids')
                ->select('bids.id as bidsid', 'products.id as product_id','fix_price_status', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')
                ->where('bids.member_id', '=', $admin_id)
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
                ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
                // ->leftJoin('messages', 'messages.bid_id', '=', 'bids.id')
                ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function($join) {
                            $join->on('bids.id', '=', 'ResultMessage.bid_id');
                        })
                        
                ->where('products.id', '=', $product_id)
                ->orderBy('bids.created_at', 'desc')
                ->get();


        //  $queries = DB::getQueryLog();
        //  $last_query = end($queries);
        //  var_dump($last_query);
        // var_dump($bid_products);
       return \View::make('bid/sent_bids')->with('bid_products', $bid_products);
    }
    
    

    public function superadminGetIndex() {

        $main_bid_products = DB::table('bids')
                ->select( 'products.id as product_id', 'fix_price_status',   'title', 'image1','currency',  DB::raw(" COUNT(products.id) AS bids_count"))

                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                 ->groupBy('products.id')
                ->orderBy('products.title', 'asc')
                ->get();
         //$queries = DB::getQueryLog();
         //$last_query = end($queries);
         //var_dump($last_query);
       // var_dump($main_bid_products);
        
        return \View::make('bid/superadminindex')->with('main_bid_products', $main_bid_products);
    }

/*
    public function superadminGetIndex() {


        $bid_products = DB::table('bids')
                ->select('bids.id as bidsid', 'fix_price_status', 'price', 'message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'owner.name as owner_name', 'currency')
                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
                ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
                ->orderBy('bids.created_at', 'desc')
                ->get();

       return \View::make('bid/superadminindex')->with('bid_products', $bid_products);
    }

*/
    
        public function superBid($product_id) {





        $bid_products = DB::table('bids')
                ->select('bids.id as bidsid', 'products.id as product_id','fix_price_status', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')

                ->join('products', 'products.id', '=', 'bids.product_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
                ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
                // ->leftJoin('messages', 'messages.bid_id', '=', 'bids.id')
                ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function($join) {
                            $join->on('bids.id', '=', 'ResultMessage.bid_id');
                        })
                        
                ->where('products.id', '=', $product_id)
                ->orderBy('bids.created_at', 'desc')
                ->get();


        //  $queries = DB::getQueryLog();
        //  $last_query = end($queries);
        //  var_dump($last_query);
       // var_dump($bid_products);
          return   \View::make('bid/super_bid')->with('bid_products', $bid_products);
    }
    
    

    /**
      When logged user adds bid
      Then letter was sent to the owner
     */
    public function add() {

        //if the fix price is set  the price is not required
        $fix_price_status = Input::get('fix_price_status');
        if (!empty($fix_price_status)) {
            $rules = array(
                'product' => 'required|numeric|exists:products,id', //product id-ről van szó
            );
        } else {

            $rules = array(
                'product' => 'required|numeric|exists:products,id', //product id-ről van szó
                'price' => 'required|numeric'
            );
        }

        $validator = Validator::make(Input::all(), $rules);

        $product_id = Input::get('product');
        // echo"<br>" . $product_id;
        if ($validator->fails()) {
            return Redirect::to('product/' . $product_id)->with('error', trans('c.The bid is not valid!'))->withInput();
        }

        $member_id = Auth::user()->id; //echo $member_id;

        $product = \App\Models\Product::find($product_id);
        $price = Input::get('price');
        $minprice = Input::get('minprice');


        if (empty($fix_price_status) && $price < $minprice) {
            return Redirect::to('product/' . $product_id)->with('error', trans('c.The price smaller than min price!'))->withInput();
        }

        \App\Models\Bid::create(
                array(
                    'member_id' => $member_id,
                    'admin_id' => Input::get('admin_id'),
                    'product_id' => $product_id,
                    'price' => $price,
                    'message' => Input::get('message')
        ));

        // $this->layout->content = View::make('hello')->with(array('message'=>'Thank you for your bid.'));

        $data = array(); //üzenet adatok

        $user = \App\Models\User::find(Auth::user()->id);
        \Mail::send('emails.bidaddmessage', $data, function($message) use ($user) {
                    $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                    $message->to($user->email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Online Auction - A message has been arrived.');
                });

        return Redirect::route('index')->with('message', trans('c.Thank you for your bid.'));
    }

    /**
      The owner of products can delete bids
     */
    public function getDelete($id, $bid_type) {

        $admin_id = Auth::user()->id; //echo  $admin_id ;
        // $res = Bid::find($id)->delete();
        $res = \App\Models\Bid::whereRaw('id=' . $id . ' AND admin_id =' . $admin_id)->delete();
       // echo $res;
    //return Redirect::to('bids/'.$product_id);

         return Redirect::to('mainbids');

  //   

    }

     public function getDeleteSuper($id) {

    

        $res = \App\Models\Bid::whereRaw('id=' . $id )->delete();
       // echo $res;

         return Redirect::to('superadminbids');

  //   

    }
    
    
    //public bid list
    public function publicBidList(Request $request) {

        $viewbag = array();
        //process sorting
        if(Input::get("sort"))
          Session::put('bidList.sort', Input::get("sort"));
        elseif(!Session::get('bidList.sort'))
          Session::put('bidList.sort', "createdasc");
        $viewbag['sort'] = $sort = Session::get('bidList.sort');

        if($viewbag['sort'] === "oppeningdesc") {
            $column = 'products.opening_price';
            $order = 'desc';
        }elseif ($viewbag['sort'] === "oppeningasc"){
            $column = 'products.opening_price';
            $order = 'asc';
        }elseif ($viewbag['sort'] === "bidasc"){
            $column = 'bids.price';
            $order = 'asc';
        }elseif ($viewbag['sort'] === "biddesc"){
            $column = 'bids.price';
            $order = 'asc';
        }else {
            $column = 'bids.created_at';
            $order = 'desc';
        }

        //process filters
        $method = strtoupper(Input::getMethod());
        if($method == "POST" && Input::get("filter")) {
          $viewbag['filter'] = array();
          $filter = array();

          if(Input::get("keyword"))
              $filter['keyword'] = Input::get("keyword");

          if(Input::get("minimalPrice") && Input::get("minimalPrice") !== "") {
              $filter['minimalPrice'] = Input::get("minimalPrice");
          }

          Session::put('bidList.filter', $filter);
        } elseif($method == "POST" && Input::get("reset")){
            Session::put('bidList.filter', array());
            Session::put('bidList.sort', "");
        }
        $filter = Session::get('bidList.filter') ?
          Session::get('bidList.filter') : array();
        $viewbag['filter'] = $filter;

        $keyword = "";
        if (isset($filter['keyword'])) {
            $keyword = $filter['keyword'];
        }

        // SQL query
        $bid_products = DB::table('bids')
        ->select('bids.id as bidsid', 'products.id as product_id','fix_price_status','products.opening_price AS opening_price', 'buynow_price', 'price', 'timelimit', DB::raw("DATEDIFF(timelimit, NOW() ) AS daydiff "), 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency')

            ->join('products', 'products.id', '=', 'bids.product_id')
            ->join('currency', 'currency.id', '=', 'products.currency_id')
            ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
            ->join('users as owner', 'owner.id', '=', 'bids.admin_id')

            ->orderBy($column, $order)
            ->where('title', 'like', "%$keyword%")
            //->get();
            ->paginate(10);
        $viewbag['bid_products'] = $bid_products;

        return   \View::make('bid/public_bid_list')->with('bid_products', $viewbag);
    }
    
    
    
}