<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
/*
  Route::get('/', function () {
  return view('welcome');
  });
 */

//change 'before' => 'auth.basic', to 'middleware' => 'auth.basic',!!
//The Language creator
Route::get('/langcreator', array('uses' => 'TranslateController@langcreator'));

// Language creator China
Route::get('/langcreator2', array('uses' => 'TranslateController@langcreator2'));

//Language creator Problematic
Route::get('/langcreator3', array('uses' => 'TranslateController@langcreator3'));


Route::get('laravel-version', function() {
    $laravel = app();
    return "Your Laravel version is " . $laravel::VERSION;
});
Route::get('/help-contact', array(
        'uses' => 'HelpContactController@helpContact'
    )
);
Route::get('/test1', array(
    'as' => 'test1',
    'uses' => 'HomeController@test'
));


Route::get('/mailtest', array(
    'uses' => 'HomeController@mailtest'
));



Route::get('start', array(
    'uses' => 'CategoryController@start'
));




Route::get('/', array(
    'as' => 'start',
    //'uses' => 'CategoryController@start'
    'uses' => 'CategoryController@categoryList'
));


Route::get('shortlist/{userid}', array(
    'uses' => 'ProductController@shortList'
));


Route::get('/index', array(
    'as' => 'index',
    'uses' => 'CategoryController@categoryList'
        )
);

Route::get('/index/{type}', array(
    //'uses' => 'ProductController@productList'
    'uses' => 'CategoryController@categoryList'
        )
);

Route::get('index/{categoryid}/{userid}', array(
    'uses' => 'ProductController@productList'
));

/*search*/
Route::post('search', array(
    'uses' => 'ProductController@productSearch'
));


Route::pattern('id', '[0-9]+');

//show product
Route::any('product/{id}', [
    "as" => "product/{id}",
    "uses" => "ProductController@product"
]);



//The Login page
Route::get("user/login", [
    "as" => "user/login",
    "uses" => "UserController@getLogin"
]);

Route::post('user/login', [
    'uses' => 'UserController@postLogin'
        ]
);

Route::any("user/logout", [
    "uses" => "UserController@getLogout"
]);

Route::get("user/create", [
    "as" => "user/create",
    "uses" => "UserController@create"
]);

Route::post("user/store", [
    "as" => "user/store",
    "uses" => "UserController@store"
]);

Route::any("user/edit", [
    "as" => "user/edit",
    "uses" => "UserController@edit"
]);


Route::get("news", [
    "as" => "news",
    "uses" => "UserController@news"
]);

//The About page
Route::get('about', array('as' => 'about', 'uses' => 'UserController@about'));

//admin
Route::any('product/adminproductlist', [
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'product/adminproductlist',
    "uses" => "ProductController@adminproductList"
]);

//edit product

Route::any('product/edit/{id}', [
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'product.postedit',
    "uses" => "ProductController@ProductEdit"
]);

Route::any('product/edit/productaddwithdropimage', [
    'middleware' => 'auth.basic',
    "uses" => "ProductController@productAddwithDropImage"
]);


////product delete
Route::get('product/delete/{id}', [
    'before' => 'auth.basic',
    "uses" => "ProductController@productDelete"
]);

//add product

Route::any('product/add', [
    // 'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    "uses" => "ProductController@productAdd"
]);

Route::any('product/productaddwithdropimage', [
    // 'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    "uses" => "ProductController@productAddwithDropImage"
]);


/////image delete
Route::get('product/edit/imagedelete/{data}', [
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    "uses" => "ProductController@imageDelete"
]);


///////////Superadmin////////////////

Route::get('superadminarea', array(
    //'before' => 'auth|isSuperadmin',
    // 'before' => 'superadmin',
    'middleware' => 'is_superadmin',
    'as' => 'superadminarea',
    'uses' => 'SuperadminController@index'
        )
);

Route::get('/superadmin/userlist', array(
    //'before' => 'superadmin',
    'middleware' => 'is_superadmin',
    'uses' => 'SuperadminController@userList'
        )
);


Route::any('product/superadminproductlist', [
    'middleware' => 'is_superadmin',
    'as' => 'product/superadminproductlist',
    "uses" => "ProductController@superadminProductList"
]);

////product confirm superadmin!!!!
Route::post('product/confirm', [
    'middleware' => 'is_superadmin',
    "uses" => "ProductController@productConfirm"
]);

Route::post('product/fee_paid', [
    'middleware' => 'is_superadmin',
    "uses" => "ProductController@feePaid"
]);


////product deny superadmin!!!!
Route::get('product/deny/{id}/{status}/{email}', [
    //'before' => 'superadmin',
    'middleware' => 'is_superadmin',
    "uses" => "ProductController@productDeny"
]);


////product delete superadmin
Route::get('product/superadmindelete/{id}', [
    'middleware' => 'is_superadmin',
    "uses" => "ProductController@productSuperadminDelete"
]);


Route::post('product_close', array(
    'middleware' => 'auth.basic',
    'uses' => 'ProductController@productClose'));

Route::post('product_open', array(
    'middleware' => 'auth.basic',
    'uses' => 'ProductController@productOpen'));


// all bids
Route::get('superadminbids', array(
    'middleware' => 'is_superadmin',
    'uses' => 'BidController@superadminGetIndex'
));

//list the arrived bids by product
Route::get('super_bid/{product_id}', array(
    'middleware' => 'is_superadmin',
    'as' => 'super_bid/{product_id}',
    'uses' => 'BidController@superBid'
));


Route::get('pub_bid_list', array(
    'uses' => 'BidController@publicBidList'
));
Route::post('pub_bid_list', array(
    'uses' => 'BidController@publicBidList'
));


Route::get('/bid/super_delete/{id}', array(
    'middleware' => 'is_superadmin',
    'as' => 'super_delete_bid',
    'uses' => 'BidController@getDeleteSuper'
        )
);

// all orders
Route::get('superadminorders', array(
    'middleware' => 'is_superadmin',
    "as" => "superadminorders",
    'uses' => 'OrderController@arrivedOrdersSuper'
));

//order detail -super
Route::get('super_order/{order_uniqid}/{status}', [
// 'before' => 'auth.basic',
    'middleware' => 'is_superadmin',
    "uses" => "OrderController@orderDetailSuper"
]);

Route::get('order_delete_super/{key}', array(
    'middleware' => 'is_superadmin',
    'uses' => 'OrderController@getDeleteSuper'
        )
);




/* * ******************* */
//Basket
Route::get("basket/basketfull", [
    "as" => "basket/basketfull",
    "uses" => "BasketController@basketfull"
]);

Route::post('basket_post', array(
    'middleware' => 'auth.basic',
    'uses' => 'BasketController@basketPost'
));

Route::post('basket/add', [
    'middleware' => 'auth.basic',
    'uses' => 'BasketController@add'
        ]
);


Route::get('basket_get', array(
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'basket_get',
    'uses' => 'BasketController@basketGet'
));


Route::get('/basket/delete/{id}', array(
    // 'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'delete_basket',
    'uses' => 'BasketController@getDelete'
        )
);


//Orders
Route::post('order', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderController@postOrder'));

Route::get('arrived_orders', array(
    //'before' => 'auth.basic',  
    'middleware' => 'auth.basic',
    "as" => "arrived_orders",
    'uses' => 'OrderController@arrivedOrders'
));

Route::get('sent_orders', array(
    // 'before' => 'auth.basic', 
    'middleware' => 'auth.basic',
    'uses' => 'OrderController@sentOrders'
));


Route::get('order/{order_uniqid}/{status}', [
// 'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    "uses" => "OrderController@orderDetail"
]);


Route::get('order_delete/{key}', array(
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'uses' => 'OrderController@getDelete'
        )
);

//Order information
Route::post('orderinformation_edit', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderinformationController@edit'
));



//remind
//Route::controller('password', 'RemindersController');
//list the arrived bids - main list
Route::get('mainbids', array(
    //  'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'mainbids',
    'uses' => 'BidController@mainIndex'
));

//list the sent bids - main list
Route::get('sentbids', array(
    // 'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'as' => 'sentbids',
    'uses' => 'BidController@mainSent'
));


//list the sent bids by product
Route::get('sentbids/{product_id}', array(
    'before' => 'auth.basic',
    'as' => 'sentbids/{product_id}',
    'uses' => 'BidController@sentBids'
));


Route::post('bid/add', [
    "as" => "bid/add",
    'before' => 'auth.basic',
    'uses' => 'BidController@add'
        ]
);

//list the arrived bids by product
Route::get('bids/{product_id}', array(
    'before' => 'auth.basic',
    'as' => 'bids/{product_id}',
    'uses' => 'BidController@arrivedBids'
));


Route::get('/bid/delete/{id}/{bid_type}', array(
    'before' => 'auth.basic',
    'as' => 'delete_bid',
    'uses' => 'BidController@getDelete'
        )
);

///////Message////////////

Route::any('message/add/{bid_id}/{recipient_id}/{product_id}', [
    'before' => 'auth.basic',
    'uses' => 'MessageController@add'
        ]
);

Route::post('message/add', [
    'middleware' => 'auth.basic',
    'uses' => 'MessageController@add'
        ]
);


Route::post('message/add2', [
    'uses' => 'MessageController@add2'
        ]
);


Route::get('visitor_message_list', [
    'middleware' => 'auth.basic',
    'uses' => 'MessageController@visitorMessageList'
        ]
);

Route::get('/message/get/{bid_id}', [
    'middleware' => 'auth.basic',
    'uses' => 'MessageController@get'
        ]
);




//Order information
// add new record
Route::get('orderinformation_add', array(
    //'before' => 'auth.basic',
    'middleware' => 'auth.basic',
    'uses' => 'OrderinformationController@add'
));

Route::get('orderinformation_get', array(
    // 'before' => 'auth.basic', 
    'middleware' => 'auth.basic',
    'uses' => 'OrderinformationController@get'
));



Route::get('/home', 'HomeController@index');

Route::auth();

//Facebook login

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');


//lang_filter 
/* Route::get('/lang/{param}', array(
  'middleware' => 'lang_filter',
  'uses' => 'ProductController@productList')
  ); */


Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);


//category list

Route::get('categorylist', array(
    "as" => "categorylist",
    'uses' => 'CategoryController@categoryList'
        )
);

//category list super
Route::get('categorylist_super', array(
    'middleware' => 'is_superadmin',
    "as" => "categorylist_super",
    'uses' => 'CategoryController@categoryListSuper'
        )
);

Route::any('category/edit/{id}', [
    'middleware' => 'is_superadmin',
    "as" => "category.edit",
    'uses' => 'CategoryController@categoryEdit'
]);


Route::any('category/add', [
    'middleware' => 'is_superadmin',
    'uses' => 'CategoryController@categoryAdd'
]);

Route::get('category/delete/{id}', [
    'middleware' => 'is_superadmin',
    "uses" => "CategoryController@categoryDelete"
]);


//for Wp plugin

Route::get('test', function() {

    $products = DB::table('products')
            ->select('products.id as id', 'title', 'opening_price', 'image1', 'maxbidprice', 'name', 'code', 'currency')
            ->where('admin_id', Request::get('userid'))
            ->where('confirm', 1)
            ->where('application_type', 1)
            ->join('currency', 'currency.id', '=', 'products.currency_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function($join) {
                $join->on('products.id', '=', 'ResultBid.product_id');
            })
            ->get();

    echo Request::get('callback') . '(' . json_encode($products) . ')';
});

//captcha

Route::group(['middleware' => 'web'], function () {
    Route::get('example', 'ExampleController@getExample');
    Route::post('example', 'ExampleController@postExample');

    Route::get('captcha', array(
        'as' => 'start',
        'uses' => 'ProductController@captcha'
    ));
});
