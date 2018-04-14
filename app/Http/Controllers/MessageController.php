<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input ;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use DB;

/**
 * This controller contains the methods of the message actions
 */
class MessageController extends Controller {

    /**
      Get messages
     */
    public function get($bid_id = '') {
          //   return   \View::make('layout.ajax');

        //$messages = Message::where('bid_id', '=', $bid_id)->orderBy('created_at', 'desc')->get();
        $messages = \App\Models\Message::with('Sender')->where('bid_id', '=', $bid_id)->orderBy('created_at', 'asc')->get();
      // var_dump($messages);
       return   \View::make('message/get', array('messages' => $messages));
    }

    /**
      The logged user can write message connected to the bid.
     */
    public function add(Request $request,$bid_id = '', $recipient_id = '', $product_id = '') {

        //echo "recipient_id: ". $recipient_id;
        if ($request->isMethod('post')) {
            $member_id = Auth::user()->id; //echo $member_id;


            \App\Models\Message::create(
                    array(
                        'bid_id' => Input::get('bid_id'),
                        'sender_id' => $member_id,
                        'recipient_id' => Input::get('recipient_id'),
                        'message' => Input::get('message')
            ));


            $data = array(); //üzenet adatok

            $recipient = \App\Models\User::find(Input::get('recipient_id'));
            \Mail::send('emails.messagecreated', $data, function($message) use ($recipient) {
                        $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                        $message->to($recipient->email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Online Auction - A message/comment has been arrived.');
                    });

           return Redirect::to('bids/'.Input::get('product_id'))->with('message', 'Message has been sent.');
        }
        return   \View::make('message/add', array('bid_id' => $bid_id, 'recipient_id' => $recipient_id, 'product_id' => $product_id));
    }

    
    
        public function add2(Request $request) {

 
        if ($request->isMethod('post')) {
            
              $rules = array(
                'email' => 'required',
                'message' => 'required',
                'captcha'   => 'required|captcha',
            );
            $inputs = Input::all(); 
            $messages = array( 'captcha' => 'The :attribute is invalid', );
            $validation = Validator::make($inputs, $rules,  $messages);
            
            if (!$validation->passes()) {
                $message[] = $validation->messages()->all();
                echo join('<br>', $message[0]);
            }else{

                               \App\Models\Message2::create(
                    array(
                        'admin_id' => Input::get('admin_id'),
                        'email' => Input::get('email'),
                        'message' => Input::get('message')
            ));


            $data = array(); //üzenet adatok

            $recipient = \App\Models\User::find(Input::get('admin_id'));
            \Mail::send('emails.messagecreated', $data, function($message) use ($recipient) {
                        $message->from(\Config::get('database.application_setting.application_email_from'), 'Site Admin');
                        $message->to($recipient->email)->cc(\Config::get('database.application_setting.application_email_cc'))->subject('Online Auction & Webshop - A message/comment has been arrived.');
                    });

           echo 'OK  Message has been sent.';  



            } 
            

        }

    }
    
    
        public function visitorMessageList() {
        $admin_id = Auth::user()->id;

        $message_list = DB::table('messages2')
                ->select()
                ->where('admin_id', '=', $admin_id)
                ->orderBy('created_at', 'desc')
                ->get();
      // var_dump($message_list);
        
     return \View::make('message/visitor_message_list')->with(array('message_list' => $message_list));
    }
    
    
}