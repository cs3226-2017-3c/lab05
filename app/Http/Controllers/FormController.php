<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;

class FormController extends Controller {
  public function test() { return view('test'); }
  
  public function check(Request $request) {
    Validator::make($request->all(), [ // as simple as this
      'nickname' => 'required|min:5|max:30',
      'fullname' => 'required|min:5|max:30',
	  'kattisacct' => 'required|min:5|max:30',
	  'nationality' => 'required',
      'g-recaptcha-response' => 'required|captcha',
    ],[
      'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
    ])->validate();
	
	$nickname = $request->input('nickname');
	$fullname = $request->input('fullname');
	$kattisacct = $request->input('kattisacct');
	$nationality = $request->input('nationality');
	DB::table('student')->insert(
		['name' => $fullname, 'nickname' => $nickname, 'kattis' => $kattisacct,
		'country' => $nationality,]);
		
	return redirect()->action('StudentController@index');
	
  }
}