<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    
    protected $application_type= 1; //auction
    
    public function __construct()
    {
       // $this->application_type = \Config::get('database.application_setting.application_type');
        $this->application_type = session()->get('application_type');
    }
    
    
     public function start()
    {
       // echo 'start';
        return \View::make('start');
    }
    
    //select category if they have products
   public function categoryList($application_type=1) {
   
       session()->put('application_type', $application_type);
       setcookie("application_type", $application_type,0,"/");
      // var_dump(session()->get('application_type'));
       // echo '||'.\App::getLocale()."||";
      // var_dump(session()->get('applocale'));

       
       //select random product picture
        $random_pictures = DB::select("SELECT image1, title, id FROM   products     WHERE products.confirm = 1 AND application_type =$application_type ORDER BY RAND() LIMIT 10" );
        //var_dump($random_pictures);
       
        $categories = DB::select("select c.id, c.name, c.picture FROM category c WHERE (SELECT COUNT(products.id) FROM products, category c2 WHERE products.category_id = c2.id AND c.id = c2.id AND products.confirm = 1 AND application_type = $application_type GROUP BY c2.id )>0 ORDER BY c.name" );

      //var_dump($categories);
      
      /*foreach ($categories as $value) {
       
          echo $value->name.'<br>';
      }*/
      return \View::make('category/category_list')->with(array('categories' => $categories, 'random_pictures' => $random_pictures));
    }

    public function categoryListSuper() {

        $categories = \App\Models\Category::orderBy('name', 'asc')->get();
        //var_dump($categories);

        return \View::make('category/category_list_super')->with(array('categories' => $categories));
    }

    public function categoryEdit(Request $request, $id) {



        if ($request->isMethod('post')) {

            $category = \App\Models\Category::find(Input::get('id'));

            $category->name = Input::get('name');
            $category->picture = Input::get('picture');
            $category->save();

            return Redirect::route("categorylist_super");
        } else {
            $category = \App\Models\Category::find($id);
            // var_dump($category);

            return \View::make('category/edit', array('category' => $category));
        }
    }

    public function categoryAdd(Request $request) {

        if ($request->isMethod('post')) {

            \App\Models\Category::create(array(
                'name' => Input::get('name'),
                'picture' => Input::get('picture')
            ));

            return Redirect::route("categorylist_super");
        } else {

            return \View::make('category/add');
        }
    }

    public function categoryDelete(Request $request, $id) {

        $category = \App\Models\Category::find($id);

        \App\Models\Category::find($id)->delete();

        return Redirect::route('categorylist_super')->with('error', 'The category is deleted.');
    }

}

