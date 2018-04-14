<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;

class OrderController extends Controller  {

    public function postOrder() {

        $member_id = Auth::user()->id;
        $basket_products = \App\Models\Basket::with('Product')->where('member_id', '=', $member_id)->get();

        if (!$basket_products) {
            return Redirect::route('index')->with('error', 'Your basket is empty.');
        }


        $order_uniqid = uniqid('order_');
        foreach ($basket_products as $item) {

            $order = \App\Models\Order::create(
                            array(
                                'member_id' => $member_id,
                                'admin_id' => $item->admin_id,
                                'product_id' => $item->product_id,
                                'quantity' => $item->quantity,
                                'bid' => $item->bid,
                                'order_uniqid' => $order_uniqid
            ));
        }

        //delete basket
        \App\Models\Basket::where('member_id', '=', $member_id)->delete();
        return Redirect::route('index')->with('message', 'The order is created.');
        //  return View::make('hello');
    }

    //sent order
    public function sentOrders_OLD() {

        $member_id = Auth::user()->id;

        $orders = DB::table('orders')
                ->select('*')
                ->join('products', 'products.id', '=', 'orders.product_id')
                ->join('users', 'users.id', '=', 'orders.member_id')
                ->where('orders.member_id', '=', $member_id)
                ->get();



        //var_dump($orders2 );
        // var_dump($orders);
        $this->layout->content = View::make('order/sent_orders')->with('orders', $orders);


        //return View::make('hello');
    }

    public function sentOrders() {

        $member_id = Auth::user()->id;

        $orders = DB::table('orders')
                ->select('order_uniqid', 'title', 'shop_price', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id')
                ->join('products', 'products.id', '=', 'orders.product_id')
                ->join('users', 'users.id', '=', 'orders.member_id')
                ->where('orders.member_id', '=', $member_id)
                ->orderBy('order_uniqid')
                ->orderBy('orders.created_at', 'desc')
                ->get();
//var_dump($orders);
        //group by basket_uniqid
        $order_uniqid = array();
        foreach ($orders as $order) {

            $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'shop_price' => $order->shop_price, 'image1' => $order->image1, 'quantity' => $order->quantity);
        }


        //  var_dump($orders_basket_uniqid);
        return \View::make('order/sent_orders')->with('orders', $order_uniqid);
    }

    //arrived orders
    public function arrivedOrders() {

        $admin_id = Auth::user()->id;

        $orders = DB::table('orders')
                ->select('order_uniqid', 'title',  'image1', 'name', 'email', 'orders.id AS order_id', 'bid')
                ->join('products', 'products.id', '=', 'orders.product_id')
                ->join('users', 'users.id', '=', 'orders.member_id')
                ->where('orders.admin_id', '=', $admin_id)
                ->orderBy('order_uniqid')
                ->orderBy('orders.created_at', 'desc')
                ->get();
//var_dump($orders);
        //group by basket_uniqid
        $order_uniqid = array();
        foreach ($orders as $order) {

            $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1);
        }


        //  var_dump($orders_basket_uniqid);
        return \View::make('order/arrived_orders')->with('orders', $order_uniqid);
    }
    
    
    
    //Superadmin
        public function arrivedOrdersSuper() {



        $orders = DB::table('orders')
                ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id')
                ->join('products', 'products.id', '=', 'orders.product_id')
                ->join('users', 'users.id', '=', 'orders.member_id')
                ->orderBy('order_uniqid')
                ->orderBy('orders.created_at', 'desc')
                ->get();
//var_dump($orders);
        //group by basket_uniqid
        $order_uniqid = array();
        foreach ($orders as $order) {

            $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'quantity' => $order->quantity);
        }


        //  var_dump($orders_basket_uniqid);
        return \View::make('order/arrived_orders_super')->with('orders', $order_uniqid);
    }
    
    
    

    public function orderDetail($order_uniqid, $status = 'admin') {



        /* $order = DB::table('orders')
          ->select('title', 'shop_price', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id')
          ->join('products', 'products.id', '=', 'orders.product_id')
          ->join('users', 'users.id', '=', 'orders.member_id')
          ->where('orders.admin_id', '=', $admin_id)
          ->where('orders.order_uniqid', '=', $order_uniqid)
          ->first(); */

        //echo 'status:'. $status ;
        if ($status == 'admin') {
            $admin_id = Auth::user()->id;
            $orders = DB::table('orders')
                    ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id', 'member_id')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('users', 'users.id', '=', 'orders.member_id')
                    ->where('orders.admin_id', '=', $admin_id)
                    ->where('orders.order_uniqid', '=', $order_uniqid)
                    ->get();
        } else if ($status == 'member') {
            $member_id = Auth::user()->id;
            $orders = DB::table('orders')
                    ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id', 'member_id')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('users', 'users.id', '=', 'orders.member_id')
                    ->where('orders.member_id', '=', $member_id)
                    ->where('orders.order_uniqid', '=', $order_uniqid)
                    ->get();
        }



      // var_dump($orders);
        //echo $orders[0]->member_id;
        $order_uniqid = array();
      foreach ($orders as $order) {
            $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'quantity' => $order->quantity);
        }

        //order information
        $orderinformation = \App\Models\Orderinformation::where('member_id', '=', $orders[0]->member_id)->first();

        return \View::make('order/order_detail')->with(array('orders' => $order_uniqid, 'orderinformation' => $orderinformation));
    }

    
        public function orderDetailSuper($order_uniqid, $status = 'admin') {


            $admin_id = Auth::user()->id;
            $orders = DB::table('orders')
                    ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id', 'member_id')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                    ->join('users', 'users.id', '=', 'orders.member_id')

                    ->where('orders.order_uniqid', '=', $order_uniqid)
                    ->get();




      // var_dump($orders);
        //echo $orders[0]->member_id;
        $order_uniqid = array();
      foreach ($orders as $order) {
            $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'quantity' => $order->quantity);
        }

        //order information
        $orderinformation = \App\Models\Orderinformation::where('member_id', '=', $orders[0]->member_id)->first();

        return \View::make('order/order_detail_super')->with(array('orders' => $order_uniqid, 'orderinformation' => $orderinformation));
    }
    
    
    
    
    
    public function getDelete($order_uniqid) {

        $admin_id = Auth::user()->id;

        $res = \App\Models\Order::whereRaw('order_uniqid="' . $order_uniqid . '" AND admin_id=' . $admin_id)->delete();

        return Redirect::route('arrived_orders');
    }
    
   public function getDeleteSuper($order_uniqid) {

        $res = \App\Models\Order::whereRaw('order_uniqid="' . $order_uniqid .'"')->delete();

        return Redirect::route('superadminorders');
    }

}