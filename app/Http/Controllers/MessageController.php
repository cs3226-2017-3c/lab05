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
    $user_id = Auth::user()->id;
    $inbox = Message::where('receiver', $user_id)->reverse()->get();
    foreach($inbox as $i){
      $sender = $i->sender;
      $receiver = $i->receiver;
      $sender = User::find($sender)->name . ' (ID: ' . $sender . ')';
      $receiver = User::find($receiver)->name . ' (ID: ' . $receiver. ')';
      $i->sender = $sender;
      $i->receiver = $receiver;
    }
    $outbox = Message::where('sender', $user_id)->reverse()->get();
    foreach($outbox as $i){
      $sender = $i->sender;
      $receiver = $i->receiver;
      $sender = User::find($sender)->name . ' (ID: ' . $sender . ')';
      $receiver = User::find($receiver)->name . ' (ID: ' . $receiver. ')';
      $i->sender = $sender;
      $i->receiver = $receiver;
    }

    $everything = null;
    if (Auth::check() and Auth::user()->access == 1 ){
      $everything = Message::all()->reverse();

      foreach($everything as $i){
        $sender = $i->sender;
        $receiver = $i->receiver;
        $sender = User::find($sender)->name . ' (ID: ' . $sender . ')';
        $receiver = User::find($receiver)->name . ' (ID: ' . $receiver. ')';
        $i->sender = $sender;
        $i->receiver = $receiver;
      }
    }
    return view('message',['inbox' => $inbox, 'outbox' => $outbox, 'everything' => $everything]);
  } 


  public function send(Request $request) {
    Validator::make($request->all(), [ // as simple as this
      'text' => array('required'),
      ])->validate();
    $user_id = Auth::user()->id;

    $new_message = new Message;

    $new_message->sender = $user_id;
    if (Auth::user()->access == 1){
      $new_message->receiver = $request->input('receiver');
    } else {
      $new_message->receiver = 1;
    }
    $new_message->text = $request->input('text');
    $new_message->save();


    flash('Message was sent!', 'success');
    return redirect()->action('MessageController@retrieve');

  }
}