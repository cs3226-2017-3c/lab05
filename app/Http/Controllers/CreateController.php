<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;

use Validator;

class CreateController extends Controller {  
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
	$new_student = new Student;
	$new_student->nickname = $request->input('nickname');
	$new_student->name = $request->input('fullname');
	$new_student->kattis = $request->input('kattisacct');
	$new_student->country = $request->input('nationality');
    $new_student->save();
    $id = $new_student->id;

    $new_score = new Score;
    $new_score->student_id = $id;
    $new_score->save();

    $new_student->latest_score_id = $new_score->id;
    $new_student->save();
		
	return redirect()->action('DetailController@detail',['id' => $id]);
	
  }
}