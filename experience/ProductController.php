<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Quotation;
use Illuminate\Support\Facades\View;
use Auth;
use Illuminate\Support\Facades\Input ;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Illuminate\Support\Facades\Redirect;

/**
 * This controller contains the list, create, edit method of the product
 * 
 * The registered and  authenticated user can create and  edit product
 * 

 */
class ProductController extends Controller {
   protected $application_type= 1; //auction
    

    public function __construct()
    {
        $this->application_type = \Config::get('database.application_setting.application_type');
    }
    public function test() {
     echo 'test';
    echo $this->application_type;
      
     }

    /**
     * role: Superadmin
     * 
     * This method lists all products
     *  the method protected with superadmin filter  Route::filter('superadmin'...) , 'before' => 'superadmin',
     */
    public function superadminProductList() {


        $products = DB::table('products')
                ->select('products.id as id', 'title', 'fix_price_status', 'opening_price', 'shop_price', 'fee','fee_paid', 'image1', 'maxbidprice', 'category.name AS category_name', 'code', 'currency', 'confirm', 'confirm_date',  'users.name AS user_name', 'users.email AS user_email' )
                ->join('users', 'users.id', '=', 'products.admin_id')
                ->join('currency', 'currency.id', '=', 'products.currency_id')
                ->leftJoin('category', 'category.id', '=', 'products.category_id')
                ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) {
                            $join->on('products.id', '=', 'ResultBid.product_id');
                        })
                ->orderBy('products.created_at', 'desc')
                ->paginate(6);

        //var_dump($sellers); // return View::make('tester');

        return \View::make('product/superadmin_product_list')->with(array('products' => $products));
    }
    
    

    /**
      Simple list the products of an user
      User can embed this page in a site
     */
    public function jsonList($callback = '', $userid = '') {

        $this->layout = null;

        if (!empty($userid)) {
            $products = DB::table('products')
                    ->select('products.id as id', 'title', 'opening_price', 'image1', 'maxbidprice', 'name', 'code', 'currency')
                    ->where('admin_id', $userid)
                    ->where('confirm', 1)
                    ->join('currency', 'currency.id', '=', 'products.currency_id')
                    ->leftJoin('category', 'category.id', '=', 'products.category_id')
                    ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) {
                                $join->on('products.id', '=', 'ResultBid.product_id');
                            })
                    ->get();

            echo $callback . json_encode($products);
            //echo  Response::json($products)->setCallback(Input::get('callback'));
            // echo Response::json($products, 200, array('Content-Type' => 'application/javascript'));
            //  echo Response::json(["test"=>"test"])->setCallback(Input::get('callback'));
        }
    }

//http://laravel.io/forum/02-14-2014-urlroute-how-to-get-the-explicitly-named-get-params
    // http://stackoverflow.com/questions/14820647/questionmark-in-url
    public function jsonCallback($callback = '', $userid = '') {
        $this->layout = null;

        echo 'valami' . '(' . "{'fullname' : 'Jeff Hansen'}" . ')';
    }

    /**
      Simple list the products of an user
      User can embed this page in a site
     */
    public function shortList($userid = '') {

        if (!empty($userid)) {
            $products = DB::table('products')
                    ->select('products.id as id', 'title', 'opening_price', 'image1', 'maxbidprice', 'name', 'code', 'currency')
                    ->where('admin_id', $userid)
                    ->where('confirm', 1)
                    ->join('currency', 'currency.id', '=', 'products.currency_id')
                    ->leftJoin('category', 'category.id', '=', 'products.category_id')
                    ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) {
                                $join->on('products.id', '=', 'ResultBid.product_id');
                            })
                    ->get();
        }

       return View::make('product/short_list')->with(array('products' => $products));
    }

    /**
      Product list by user and all product
      The list is paginated
     */
    public function productList($categoryid='', $userid = '') {

              $application_type = session()->get('application_type');
              var_dump(session()->get('application_type'));
               if (!empty($categoryid)) {

                $products = DB::table($application_type.'_products')
                        ->select($application_type.'_products.id as id', 'title', 'shop_price','fix_price_status', 'opening_price', 'image1', 'maxbidprice', 'category.name AS category_name', 'code', 'currency', 'users.name AS user_name')
                        ->where('confirm', 1)
                        ->join('users', 'users.id', '=', $application_type.'_products.admin_id')
                        ->join('currency', 'currency.id', '=', $application_type.'_products.currency_id')
                        ->join('category', function($join) use ($categoryid, $application_type)
                         {
                             $join->on('category.id', '=', $application_type.'_products.category_id');
                             $join->on( 'category.id', '=', DB::raw("'".$categoryid."'"));
                         })
                        ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) use($application_type) {
                                    $join->on($application_type.'_products.id', '=', 'ResultBid.product_id');
                                })
                        ->paginate(6);
            }else if (!empty($userid)) {

                $products = DB::table($application_type.'_products')
                        ->select($application_type.'_products.id as id', 'title', 'shop_price','fix_price_status', 'opening_price', 'image1', 'maxbidprice', 'category.name AS category_name', 'code', 'currency', 'users.name AS user_name')
                        ->where('admin_id', $userid)
                        ->where('confirm', 1)
                        ->join('users', 'users.id', '=', $application_type.'_products.admin_id')
                        ->join('currency', 'currency.id', '=', $application_type.'_products.currency_id')
                        ->leftJoin('category', 'category.id', '=', $application_type.'_products.category_id')
                        ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) use($application_type) {
                                    $join->on($application_type.'_products.id', '=', 'ResultBid.product_id');
                                })
                        ->paginate(6);
            } 
            


        //  var_dump($products);


            /**
              select user who have product
             */
            $sellers = DB::table('users')
                    ->select('users.id as id', 'users.name as name')
                    ->distinct()
                    ->join($application_type.'_products', $application_type.'_products.admin_id', '=', 'users.id')
                    ->where('confirm', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            ;

          //var_dump($sellers); // return View::make('tester');

        //    $this->layout->content = View::make('product/product_list')->with(array('products' => $products, 'sellers' => $sellers));
              return View::make('product/product_list')->with(array('products' => $products, 'sellers' => $sellers));

    }

    /**
      This method is the  view of the product
     */
    public function product($id) {

        $application_type = session()->get('application_type');
        var_dump(session()->get('application_type'));

        $product = DB::table($application_type.'_products')
                ->select($application_type.'_products.id AS id','admin_id', 'title', 'description', 'shop_price', 'fix_price_status', 'opening_price', 'lowest_price', 'buynow_price', 'currency.code AS currency_code', 'currency.currency AS currency_currency', 'category.name AS category_name', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10'
                        , 'users.name AS user_name')
                ->where($application_type.'_products.id', $id)
                ->where('confirm', 1)
                ->join('users', 'users.id', '=', $application_type.'_products.admin_id')
                ->join('currency', 'currency.id', '=', $application_type.'_products.currency_id')
                ->leftJoin('category', 'category.id', '=', $application_type.'_products.category_id')
                ->first();

        // var_dump($product);
        //echo  $product->opening_price;

        $minprice = \App\Models\Bid::where('product_id', '=', $id)->max('price');

        if (empty($minprice)) {
            $minprice = $product->opening_price;
        }
        // echo   "minprice $minprice";

      return \View::make('product/product')->with(array('product' => $product, 'minprice' => $minprice));
    }

    /**
      The product list of the authenticated user
     */
    public function adminproductList() {

        //  $products = Product::where('admin_id', '=', Auth::user()->id)->get();
        
        $application_type = session()->get('application_type');
        var_dump(session()->get('application_type'));

        $products = DB::table($application_type.'_products')
                ->where('admin_id', '=', Auth::user()->id)
                ->select($application_type.'_products.id as id', 'title', 'shop_price', 'fix_price_status', 'opening_price', 'image1', 'maxbidprice', 'category.name AS category_name', 'code', 'currency', 'confirm')
                ->join('currency', 'currency.id', '=', $application_type.'_products.currency_id')
                ->leftJoin('category', 'category.id', '=', $application_type.'_products.category_id')
                ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) use($application_type) {
                            $join->on($application_type.'_products.id', '=', 'ResultBid.product_id');
                        })
                ->paginate(5);

        // var_dump($products);
        return \View::make('product/adminproduct_list')->with(array('products' => $products, 'userid' => Auth::user()->id));
    }

    /**
      This method edits the data of the product
     */
    public function productEdit(Request $request, $id) {

        /**
          If the form was sent
         */
        $status_saved = 0;
        if ($request->isMethod('post')) {
           // $this->layout = View::make('layout.null');
            $inputs = Input::all();
            //var_dump($inputs); //echo "id: " . Input::get('id');

            $rules = array(
                'title' => 'required',
                'description' => 'required',
                //'opening_price' => 'required',
                    // 'lowest_price' => 'required',
                    //'buynow_price' => 'required',
            );


            $validation = Validator::make($inputs, $rules);


            //  

            $id = Input::get('id');
            if (!$validation->passes()) {
                // var_dump($validation->messages());
                // return Redirect::to("product/edit/" . $id)->withErrors($validation->messages())->withInput();
                $message[] = $validation->messages()->all();
                echo join('<br>', $message[0]);
            } else {

                /**
                  Deal with images
                 */
                $images_str = Input::get('images_str');
                $imagesArr = explode(",", $images_str);
                //  var_dump($imagesArr);


                $imagePathArr = array();
                $destinationPath = public_path() . '/uploads/products/originals';


                for ($n = 1; $n <= 10; ++$n) {

                    $i = $n - 1;
                    if (array_key_exists($i, $imagesArr) && !empty($imagesArr[$i])) {

                        try {

                            $fileArr = explode("|", $imagesArr[$i]);
                            $filename = $fileArr[0];
                            // echo "filename: $filename <br>";

                            if (substr($filename, 0, 5) == "temp_") {


                                $memoryAvailable = filter_var(ini_get("memory_limit"), FILTER_SANITIZE_NUMBER_INT) * 1048576;
                                //getting the image width and height
                                $imageInfo = getimagesize($destinationPath . '/' . $filename);
                                if ($imageInfo["mime"] == "image/png") {
                                    $pngImageInfo = $this->get_png_imageinfo($directory . '/' . $filenameWithExtension);
                                    // var_dump($pngImageInfo["channels"]);
                                    $imageInfo['channels'] = $pngImageInfo["channels"];
                                }
                                //This is quite rough and includes a fudge factor, 2.5, which you may want to experiment with.
                                $requiredMemory = ( $imageInfo[0] * $imageInfo[1] * ($imageInfo['bits'] / 8) * $imageInfo['channels'] * 2.5 );

                                if (memory_get_usage() + $requiredMemory < $memoryAvailable) {
                                    /**
                                      Medium upload
                                     */
                                    $img = Image::make($destinationPath . '/' . $filename);
                                    $img->resize(500, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                    // and insert a watermark for example
                                    //$img->insert('public/watermark.png');
                                    $newfilename = substr($filename, 5);
                                    $img->save(public_path() . '/uploads/products/thumbs/medium/' . $newfilename);

                                    /**
                                      Small upload
                                     */
                                    $img = Image::make($destinationPath . '/' . $filename);
                                    $img->resize(200, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                            });
                                    $img->save(public_path() . '/uploads/products/thumbs/small/' . $newfilename);

                                    //delete original file
                                    File::delete(public_path() . '/uploads/products/originals/' . $filename);

                                    $imagePathArr[$n] = $newfilename;
                                } else {
                                    $newfilename = substr($filename, 5);
                                    //small picture
                                    copy(public_path() . '/uploads/default.jpg', public_path() . '/uploads/products/thumbs/small/' . $newfilename);
                                    //medium picture
                                    rename($destinationPath . '/' . $filename, public_path() . '/uploads/products/thumbs/medium/' . $newfilename);
                                    //$fileArr[1] - original filename
                                    $messageArr[] = $fileArr[1] . ' is too big. The picture was saved but thumbnail wasn\'t created';
                                    $imagePathArr[$n] = $newfilename;
                                    Log::info('Reduce the file size of the /uploads/products/thumbs/medium/' . $newfilename . ' picture  manually. The server can convert smaller picture. ');
                                }
                            } else {
                                $imagePathArr[$n] = $filename;
                            }
                        } catch (Exception $e) {
                            // return Redirect::route('index')->with('message', ' error');
                            echo "Error:" . $e;
                        }
                    } else {
                        $imagePathArr[$n] = 'default.jpg';
                    }
                }


                /**
                  Writing product data into database
                 */
                
              $application_type = session()->get('application_type');
             // var_dump(session()->get('application_type'));
                  
               $productObj = new \App\Models\Product(['zs_table_name' =>$application_type.'_products']);
                //$productObj->setTable($application_type.'_products');
                
               // $product = \App\Models\Product::find($id);
                $product = $productObj::find($id);
                $product->title = Input::get('title');
                $product->description = Input::get('description');
                $product->image1 = $imagePathArr[1];
                $product->image2 = $imagePathArr[2];
                $product->image3 = $imagePathArr[3];
                $product->image4 = $imagePathArr[4];
                $product->image5 = $imagePathArr[5];
                $product->image5 = $imagePathArr[5];
                $product->image6 = $imagePathArr[6];
                $product->image7 = $imagePathArr[7];
                $product->image8 = $imagePathArr[8];
                $product->image9 = $imagePathArr[9];
                $product->image10 = $imagePathArr[10];
                $product->shop_price = Input::get('shop_price');
                $product->fix_price_status = Input::get('fix_price_status');
                $product->opening_price = Input::get('opening_price');
                $product->lowest_price = Input::get('lowest_price');
                $product->buynow_price = Input::get('buynow_price');
                $product->currency_id = Input::get('currency_id');
                $product->category_id = Input::get('category_id');
                $product->save();

                // return Redirect::to("product/myproducts");
                $status_saved = 1;
            }
        }


        $category_list = \App\Models\Category::orderBy('name')->lists('name', 'id');

        //var_dump($category_list);

        /**
          Image name string for the edit form
         */
        
        // http://stackoverflow.com/questions/30502922/a-construct-on-an-eloquent-laravel-model
        
        
        $images_str = "";
        $application_type = session()->get('application_type');
        var_dump(session()->get('application_type'));
        $productObj = new \App\Models\Product(['zs_table_name' =>$application_type.'_products']);
       // $productObj->setTable($application_type.'_products');
        //$product = \App\Models\Product::find($id);
        $product = $productObj::find($id);
        // echo "admin_id: ".$product->admin_id. ", logged user id: ".Auth::user()->id. ", admin role: ".Auth::user()->admin;
        //protect data from tricky user
        // Superadmin access: Auth::user()->admin ==2 
        if (
                $product->admin_id == 
                Auth::user()->id || 
                Auth::user()->admin == 2
                ) {
            for ($n = 1; $n <= 10; ++$n) {
                // echo $product['image' . $n]."<br>"; 
                if ($product['image' . $n] != "default.jpg") {
                    $images_str .= $product['image' . $n] . ",";
                }
            }


            /**
              List of the currency
             */
            $currency_list = \App\Models\Currency::orderBy('code')->get()->lists('CurrencyFullName', 'id');

            if ($status_saved == 0) {
             return   \View::make('product/edit', array('category_list' => $category_list, 'images_str' => $images_str, "currency_list" => $currency_list, 'product' => $product));
            } else {


                //    Session::flash('edit_success', 'The modification is saved.'); 

                /*  $this->layout->content = View::make('product/edit', array(
                  'category_list' => $category_list,
                  'images_str' => $images_str,
                  "currency_list" => $currency_list,
                  'product' => Product::find($id),
                  'edit_success' => 'The modification is saved.'
                  )); */

                echo 'The modification is saved.';
            }
            ///////////////
        } else {
            return Redirect::route('product/adminproductlist')->with('error', 'This page is not allowed for you. You are redirected to here.');
        }
    }

    /**
      This method deletes images when the product is deleted
     */
    public function imageDelete($data) {


        $arr = explode("-", $data);
        $id = $arr[1];

        //  echo  $arr[2];
        if (substr($arr[2], 0, 5) != "temp_") {

            $product = \App\Models\Product::find($id);

            for ($n = 1; $n <= 10; ++$n) {
                // echo ' | '.$product['image' . $n].' | ';
                if ($product['image' . $n] == $arr[2]) {
                    //   echo $arr[2];  
                    // for id element removing
                    echo substr($arr[2], 0, -4);
                    //change to default.jpg  


                    File::delete(public_path() . '/uploads/products/thumbs/small/' . $arr[2]);
                    File::delete(public_path() . '/uploads/products/thumbs/medium/' . $arr[2]);

                    $product->{'image' . $n} = "default.jpg";
                    $product->save();
                }
            }
        } else {
            echo substr($arr[2], 0, -4);
            File::delete(public_path() . '/uploads/products/originals/' . $arr[2]);
        }




        return   \View::make('tester');
    }

    /**
      This method deletes product
     */
    public function productDelete($id) {

        $admin_id = Auth::user()->id;
        // $product = Product::find($id);
        $productObj = \App\Models\Product::where('id', '=', $id)->where('admin_id', '=', $admin_id)->get();


        // var_dump($productObj);
        // var_dump($productObj[0]->image1);
        $product = $productObj[0];
        //delete picture
        for ($n = 1; $n < 6; ++$n) {

            if ($product['image' . $n] != "default.jpg") {
                File::delete(public_path() . '/uploads/products/thumbs/small/' . $product['image' . $n]);
                File::delete(public_path() . '/uploads/products/thumbs/medium/' . $product['image' . $n]);
            }
        }


        \App\Models\Product::find($id)->delete();
        return Redirect::route('product/adminproductlist')->with('error', 'The auction is deleted.');



        //return View::make('tester');
    }

    /**
      Superadmin can delete  product
      the method protected with superadmin filter  Route::filter('superadmin'...) , 'before' => 'superadmin',
     */
    public function productSuperadminDelete($id) {

        $product = \App\Models\Product::find($id);

        //delete picture
        for ($n = 1; $n < 6; ++$n) {

            if ($product['image' . $n] != "default.jpg") {
                File::delete(public_path() . '/uploads/products/thumbs/small/' . $product['image' . $n]);
                File::delete(public_path() . '/uploads/products/thumbs/medium/' . $product['image' . $n]);
            }
        }


        \App\Models\Product::find($id)->delete();
        return Redirect::route('product/superadminproductlist')->with('error', 'The auction is deleted.');



        //return View::make('tester');
    }

    /**
      This method permits the public view of the product
     *   the method protected with superadmin filter  Route::filter('superadmin'...) , 'before' => 'superadmin',
     */
    public function productConfirm() {

        $product = \App\Models\Product::find(Input::get('product_id'));
        $product->confirm = 1;
        $product->fee = Input::get('fee');
        $product->confirm_date = date("Y-m-d");
        $product->save();

 
            $foomessage = 'The product is allowed.';
            
               $data = array(
                'fee' =>    number_format((float)Input::get('fee'), 2, '.', ''),
                'currency' => \Config::get('database.application_setting.application_fee_currency')
               );

                //$user = \App\Models\User::find(Auth::user()->id);
              
            $email = Input::get('email');
            
                         \Mail::send('emails.auctionallowed', $data, function($message) use ($email) {
                            $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                            $message->to($email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Your product is allowed.');
                        });
            


        return Redirect::route('product/superadminproductlist')->with('message', $foomessage);

        //return View::make('tester');
    }
    
    
        public function productDeny($id, $status = 0, $email='') {

        $product = \App\Models\Product::find($id);
        $product->confirm = $status;
        $product->save();


        $foomessage = 'The product is denied.';


        return Redirect::route('product/superadminproductlist')->with('message', $foomessage);

        //return View::make('tester');
    }

    
    
        public function feePaid() {

        $product = \App\Models\Product::find(Input::get('product_id'));
        $product->fee_paid =Input::get('fee_paid');
        $product->save();

       if(Input::get('fee_paid') ==1){
           
            $foomessage = ' The fee of the product publishing is arrived.';
            
               $data = array();
              
               $email = Input::get('email');
            
                         \Mail::send('emails.fee_paid', $data, function($message) use ($email) {
                            $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                            $message->to($email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('The fee of the product publishing is arrived.');
                        });
            
       }
       else{
           $foomessage = 'The fee of the product publishing is not arrived.';
       }

        return Redirect::route('product/superadminproductlist')->with('message', $foomessage);

        //return View::make('tester');
    }
    
    
    
    /**
      This method adds product
     */
    public function productAdd(Request $request) {

//echo "application_domain: " . \Config::get('database.application_setting.application_domain') .'<br>';
//echo " application_email_from: " . \Config::get('database.application_setting.application_email_from').'<br>' ;
//echo " application_email_cc: " . \Config::get('database.application_setting.application_email_cc').'<br>' ;
        //echo "lang: " . App::getLocale(); 
        // if POST request
       if ($request->isMethod('post')) {
            //$this->layout = View::make('layout.null');
            //return Redirect::back()->withInput();

            if ($this->application_type == 1) {
                $rules = array(
                    'title' => 'required',
                    'description' => 'required',
                    'opening_price' => 'required',
                        //'lowest_price' => 'required',
                        // 'buynow_price' => 'required',
                );
            } else if ($this->application_type == 2) {
                $rules = array(
                    'title' => 'required',
                    'description' => 'required',
                    'shop_price' => 'required',
                );
            }

            $inputs = Input::all();
            //  var_dump($inputs);
            //message translation

            $validation = Validator::make($inputs, $rules);




            // If Validation failes
            if (!$validation->passes()) {

                // back values to the form
                // var_dump($validation->messages());
                // return Redirect::to("product/add")->withErrors($validation->messages())->withInput();

                $message[] = $validation->messages()->all();
                //var_dump($message[0]);
                echo join('<br>', $message[0]);
            } else {

                //Deal with images
                $images_str = Input::get('images_str');
                $imagesArr = explode(",", $images_str);
                //  var_dump($imagesArr);


                $imagePathArr = array();
                $destinationPath = public_path() . '/uploads/products/originals';

                // message Arr for picture error message
                $messageArr = array();
                for ($n = 1; $n <= 10; ++$n) {

                    $i = $n - 1;

                    if (array_key_exists($i, $imagesArr) && !empty($imagesArr[$i])) {


                        $fileArr = explode("|", $imagesArr[$i]);
                        $filename = $fileArr[0];

                        //  echo "filename: $filename <br>";
                        //using Intervention Image package
                        /*  Medium upload * */
                        // open an image file


                        $memoryAvailable = filter_var(ini_get("memory_limit"), FILTER_SANITIZE_NUMBER_INT) * 1048576;

                        //getting the image width and height
                        $imageInfo = getimagesize($destinationPath . '/' . $filename);
                        if ($imageInfo["mime"] == "image/png") {
                            $pngImageInfo = $this->get_png_imageinfo($directory . '/' . $filenameWithExtension);
                            // var_dump($pngImageInfo["channels"]);
                            $imageInfo['channels'] = $pngImageInfo["channels"];
                        }
                        //This is quite rough and includes a fudge factor, 2.5, which you may want to experiment with.
                        $requiredMemory = ( $imageInfo[0] * $imageInfo[1] * ($imageInfo['bits'] / 8) * $imageInfo['channels'] * 2.5 );

                        //check memory usage
                        //Log::info(memory_get_usage() . ' | ' . memory_get_peak_usage(false) . '|' . memory_get_peak_usage(true) . ' | '. $requiredMemory .'|' . $memoryAvailable);


                        if (memory_get_usage() + $requiredMemory < $memoryAvailable) {

                            $img = Image::make($destinationPath . '/' . $filename);
                            //Get image size
                            $imgArr = getimagesize($destinationPath . '/' . $filename);
                            //echo "width: ".$imgArr[0];
                            if ($imgArr[0] < 500) {
                                $img->resize($imgArr[0], null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                            } else {
                                $img->resize(500, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                        });
                            }

                            // and insert a watermark for example
                            //$img->insert('public/watermark.png');
                            $newfilename = substr($filename, 5);
                            $img->save(public_path() . '/uploads/products/thumbs/medium/' . $newfilename);
                            /*  Small upload * */
                            // $img = Image::make($destinationPath . '/' . $filename);
                            $img->resize(200, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    });
                            $img->save(public_path() . '/uploads/products/thumbs/small/' . $newfilename);
                            //delete original file
                            File::delete(public_path() . '/uploads/products/originals/' . $filename);

                            $imagePathArr[$n] = $newfilename;
                        } else {
                            $newfilename = substr($filename, 5);
                            //small picture
                            copy(public_path() . '/uploads/default.jpg', public_path() . '/uploads/products/thumbs/small/' . $newfilename);
                            //medium picture
                            rename($destinationPath . '/' . $filename, public_path() . '/uploads/products/thumbs/medium/' . $newfilename);
                            //$fileArr[1] - original filename
                            $messageArr[] = $fileArr[1] . ' is too big. The picture was saved but thumbnail wasn\'t created';
                            $imagePathArr[$n] = $newfilename;
                            Log::info('Reduce the file size of the /uploads/products/thumbs/medium/' . $newfilename . ' picture  manually. The server can convert smaller picture. ');
                        }
                    } else {
                        $imagePathArr[$n] = 'default.jpg';
                    }
                }

                // echo "<hr> imagePathArr: <br>";
                //var_dump($imagePathArr);

                \App\Models\Product::create(array(
                    'title' => Input::get('title'),
                    'description' => Input::get('description'),
                    'image1' => $imagePathArr[1],
                    'image2' => $imagePathArr[2],
                    'image3' => $imagePathArr[3],
                    'image4' => $imagePathArr[4],
                    'image5' => $imagePathArr[5],
                    'image6' => $imagePathArr[6],
                    'image7' => $imagePathArr[7],
                    'image8' => $imagePathArr[8],
                    'image9' => $imagePathArr[9],
                    'image10' => $imagePathArr[10],
                    'shop_price' => Input::get('shop_price'),
                    'fix_price_status' => Input::get('fix_price_status'),
                    'opening_price' => Input::get('opening_price'),
                    //     'lowest_price' => Input::get('lowest_price'),
                    'buynow_price' => Input::get('buynow_price'),
                    'currency_id' => Input::get('currency_id'),
                    'category_id' => Input::get('category_id'),
                    'admin_id' => Auth::user()->id,
                    'confirm' => 0
                ));






                $data = array(
                );

                $user = \App\Models\User::find(Auth::user()->id);
//https://laravel.com/docs/5.0/mail#mail-and-local-development
                //View [emails.auctioncreated] not found
             \Mail::send('emails.auctioncreated', $data, function($message) use ($user) {
                            $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                            $message->to($user->email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Online Auction - waiting for moderation. Thank you for your upload.');
                        });



                // return View::make('tester');
                $messagePart = join(", ", $messageArr);
                // return Redirect::route('product/adminproductlist')->with('message', 'Thank you for your upload. Waiting for moderation ' . $messagePart);

                echo 'OK' . 'Thank you for your upload. Waiting for moderation. <br>' . $messagePart;
            }
        }else{
                   // return View::make('hello');  //test template
        $category_list =  \App\Models\Category::orderBy('name')->lists('name', 'id');


        //var_dump($category_list);
        //$catObj = new Category(); $getcategoryName = $catObj -> getCategory(3); //var_dump($getcategoryName);
        //var_dump(Category::getCategoryCount());
        //  View template 


        $currency_list =  \App\Models\Currency::orderBy('code')->get()->lists('CurrencyFullName', 'id');

        $mycurrency_id =  \App\Models\User::find(Auth::user()->id)->currency_id;

        return \View::make('product/add', array('category_list' => $category_list, 'currency_list' => $currency_list, "mycurrency_id" => $mycurrency_id)); 
        }


    }

    /**
      The utility method checks that the Input is Post format
     */
    //laravel 4
    /*protected function isPostRequest() {
        return Request::server("REQUEST_METHOD") == "POST";
    }*/

    /**
      Drag&drop utility server side
     */
    public function productAddwithDrop() {
        // return View::make('product/productaddwithdrop');

        $category_list = Category::orderBy('name')->lists('name', 'id');


        return View::make('product/productaddwithdrop', array('category_list' => $category_list));
    }

    /**
      Drag&drop utility - slave method
      This method rename, save picture
      resize to 500 px method added
     */
    public function productAddwithDropImage() {

        $input = Input::all();
        $rules = array(
            'image' => 'image|max:20000',
        );

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            //  return Response::make($validation->errors->first(), 400);
            echo "filenotvalid";
        } else {
            $file = Input::file('image');

            $pubpath = public_path();
            //echo " pubpath: $pubpath";

            $extension = $file->getClientOriginalExtension();

            $directory = $pubpath . '/uploads/products/originals/';

            $filename = 'temp_auction_' . Auth::user()->id . '_' . str_random(32);
            $filenameWithExtension = $filename . '.' . $extension;

            $upload_success = $file->move($directory, $filenameWithExtension);

            //resize picture
            $this->resize($filenameWithExtension);

            if ($upload_success) {

                // original filename for error message
                $filename = $file->getClientOriginalName();
                //echo Response::json('success', 200);
                echo $filenameWithExtension . '|' . $filename;
                // return Response::json('success', 200);
            } else {
                echo Response::json('error', 400);
                // return Response::json('error', 400);
            }
        }
    }

    /**
      resize to 500 px method
     */
    public function resize($img) {

        $imageInfo = getimagesize(public_path() . '/uploads/products/originals/' . $img);
        //var_dump($imageInfo);
        $width_orig = $imageInfo[0];
        $height_orig = $imageInfo[0];

        //500 size
        $dst_width = 500;
        $dst_height = ($dst_width / $width_orig) * $height_orig;
        $im = imagecreatetruecolor($dst_width, $dst_height);

        if ($imageInfo["mime"] == "image/png") {
            $image = imagecreatefrompng(public_path() . '/uploads/products/originals/' . $img);
        } else if ($imageInfo["mime"] == "image/jpeg")  {
            $image = imagecreatefromjpeg(public_path() . '/uploads/products/originals/' . $img);
        }  else if ($imageInfo["mime"] == "image/gif")  {
            $image = imagecreatefromgif(public_path() . '/uploads/products/originals/' . $img);
        }else die("Picture format problem");

        //move picture
        imagecopyresampled($im, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width_orig, $height_orig);
        //save memory
        imagejpeg($im, public_path() . '/uploads/products/originals/' . $img);

        imagedestroy($im);
    }

    /*
      Miscellaneous/get_png_imageinfo/get_png_imageinfo.php

      https://github.com/ktomk/Miscellaneous/blob/master/get_png_imageinfo/get_png_imageinfo.php
     */

    /**
     * Get image-information from PNG file
     *
     * php's getimagesize does not support additional image information
     * from PNG files like channels or bits.
     *
     * get_png_imageinfo() can be used to obtain this information
     * from PNG files.
     *
     * @author Tom Klingenberg <lastflood.net>
     * @license Apache 2.0
     * @version 0.1.0
     * @link http://www.libpng.org/pub/png/spec/iso/index-object.html#11IHDR
     *
     * @param string $file filename
     * @return array|bool image information, FALSE on error
     */
    function get_png_imageinfo($file) {
        if (empty($file))
            return false;
        $info = unpack('A8sig/Nchunksize/A4chunktype/Nwidth/Nheight/Cbit-depth/' .
                'Ccolor/Ccompression/Cfilter/Cinterface', file_get_contents($file, 0, null, 0, 29))
        ;
        if (empty($info))
            return false;
        if ("\x89\x50\x4E\x47\x0D\x0A\x1A\x0A" != array_shift($info))
            return false; // no PNG signature.
        if (13 != array_shift($info))
            return false; // wrong length for IHDR chunk.
        if ('IHDR' !== array_shift($info))
            return false; // a non-IHDR chunk singals invalid data.
        $color = $info['color'];
        $type = array(0 => 'Greyscale', 2 => 'Truecolour', 3 => 'Indexed-colour',
            4 => 'Greyscale with alpha', 6 => 'Truecolour with alpha');
        if (empty($type[$color]))
            return false; // invalid color value
        $info['color-type'] = $type[$color];
        $samples = ((($color % 4) % 3) ? 3 : 1) + ($color > 3);
        $info['channels'] = $samples;
        $info['bits'] = $info['bit-depth'];
        return $info;
    }

}
