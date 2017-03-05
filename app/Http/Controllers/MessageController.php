<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use Carbon\Carbon;

use Validator;

class MessageController extends Controller {  
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function retrieve() {
    $user_id = Auth::id();
    $inbox = Message::where('receiver', $user_id)->get();
    foreach($inbox as $i){
      $sender = $i->sender;
      $receiver = $i->receiver;
      $sender = User::find($sender)->name;
      $receiver = User::find($receiver)->name;
      $i->sender = $sender;
      $i->receiver = $receiver;
    }
    $outbox = Message::where('sender', $user_id)->get();
    foreach($outbox as $i){
      $sender = $i->sender;
      $receiver = $i->receiver;
      $sender = User::find($sender)->name;
      $receiver = User::find($receiver)->name;
      $i->sender = $sender;
      $i->receiver = $receiver;
    }
    return view('message',['inbox' => $inbox, 'outbox' => $outbox]);
  } 


  public function send(Request $request) {
    Validator::make($request->all(), [ // as simple as this
      'receiver' => array('required'),
      'text' => array('required'),
      ])->validate();
    $user_id = Auth::id();

    $new_message = new Message;

    $new_message->sender = $user_id;

    $new_message->receiver = $request->input('receiver');
    $new_message->text = $request->input('text');
    $new_message->save();


    flash('Message was sent!', 'success');
    return redirect()->action('MessageController@retrieve');

  }
}