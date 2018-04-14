<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\TranslateClient;

class TranslateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    
    

        public function langcreator() {


        header('Content-Type: text/html; charset=utf-8');

        \App::setLocale('en');

        echo "Lang creator: <br>";

        $eng_lang_array_full = \Lang::get('c'); // return entire array
        
        $i=0;
        foreach ($eng_lang_array_full as $value) {
          $eng_lang_orig_array[] = $value;
          $eng_lang_array[] = "xx".$i."x: ".$value;
          $i++;
        }
        
        //$eng_lang_array = array_values($eng_lang_array_full); 
        
        //var_dump($eng_lang_array);
        
        $eng_lang_block = implode('||',$eng_lang_array); 
        
       // echo $eng_lang_block ;

        $tr = new TranslateClient();

        $tr->setSource("en");


$code_lang_array = [

'en' => 'English',
'fr' => 'French',
'ro' => 'Romanian',



];
        
       //'hu' => 'Hungarian',
       $key_arr =  array_keys($code_lang_array);
       $code_lang = $key_arr[46];   
       echo " KEY: ". $code_lang." ";
       $tr->setTarget($code_lang);
       
       //$translated_lang_block ='';
      $translated_lang_block = $tr->translate( $eng_lang_block);
      // $translated_lang_block =  $eng_lang_block;
       
       $translated_lang_array = explode('||',$translated_lang_block);
       
     //var_dump($translated_lang_array);
       
       $new_translated_lang_array =array();
      foreach ($translated_lang_array as $value) {
          
        //  echo $value.'<br>';
          if (preg_match("/(xx)(\d+)(x\: )(.*)/", $value, $match)) {
          //  var_dump($match);
            $new_translated_lang_array[$match[2]] =  $match[4];
          }

      }
      
       $lang_str ='';
       
    // var_dump( $new_translated_lang_array);

      foreach ($eng_lang_orig_array as $key=>$item) {
           if(isset($new_translated_lang_array[$key])){
            $lang_str .= '"' . $item . '"=>"' .trim($new_translated_lang_array[$key]) . '",'."\n";
           }
        } 


       
        echo $lang_str;
        
        $apppath = "C:\server\UniServerZ_2017\www\projects\laravel5\alltime";

           
        $directory = $apppath . '/resources/lang/'.$code_lang.'/';  

            if (!is_dir($directory))
            {
                mkdir($directory);
            }
            
        $fp1 = fopen($directory."c.php", 'w');
        fwrite($fp1, "<?php \n return array( \n ". $lang_str .' );');
        
    }
    
    
    
        public function langcreator2() {


        header('Content-Type: text/html; charset=utf-8');

       \App::setLocale('en');

        echo "Lang creator: <br>";

        $array = \Lang::get('c'); // return entire array
        //   var_dump($array);

        $tr = new TranslateClient();

        $tr->setSource("en");
        

        $code_lang = "sr"; 
 
        $tr->setTarget($code_lang);


        $lang_str='';
        
        foreach ($array as $item) {

             $lang_str .= '"' . $item . '"=>"' . $tr->translate($item) . '",'."\n";
        }
        
         echo $lang_str;
        
        $apppath = "C:\server\UniServerZ_2017\www\projects\laravel5\alltime";

           
        $directory = $apppath . '/resources/lang/'.$code_lang.'/';  

            if (!is_dir($directory))
            {
                mkdir($directory);
            }
            
        $fp1 = fopen($directory."c.php", 'w');
        fwrite($fp1, "<?php \n return array( \n ". $lang_str .' );');
    }

    
      //only print   
    public function langcreator3() {


        header('Content-Type: text/html; charset=utf-8');

       \App::setLocale('en');

      //  echo "Lang creator: <br>";

        $array = \Lang::get('c'); // return entire array
        //   var_dump($array);

        $tr = new TranslateClient();

        $tr->setSource("en");
        

        $code_lang = "sr"; 
 
        $tr->setTarget($code_lang);


        $lang_str='';
        
        foreach ($array as $item) {

             $lang_str .= '"' . $item . '"=>"' . $tr->translate($item) . '",'."\n";
        }
        
         echo $lang_str;
        

    }
}
