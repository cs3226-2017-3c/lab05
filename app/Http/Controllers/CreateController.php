<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Carbon\Carbon;

use Validator;

class CreateController extends Controller {  
  public function __construct()
  {
    $this->middleware('auth');
  }

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
    $user_id = Auth::id();

    $new_student = new Student;

    if($request->hasFile('avatar')){
      $path = $request->file('avatar')->store("public/avatar");
      $new_student->avatar = $path;
    }
    $new_student->nickname = $request->input('nickname');
    $new_student->name = $request->input('fullname');
    $new_student->kattis = $request->input('kattisacct');
    $new_student->country = $request->input('nationality');
    $new_student->comment = $request->input('comment');
    $new_student->created_by = $user_id;
    $new_student->updated_by = $user_id;
    $new_student->save();
    $id = $new_student->id;

    $new_score = new Score;
    $new_score->student_id = $id;
    $new_score->created_by = $user_id;
    $new_score->updated_by = $user_id;
    $new_score->effective_from = Carbon::now();
    $new_score->save();

    $new_student->latest_score_id = $new_score->id;
    $new_student->save();

    return redirect()->action('DetailController@detail',['id' => $id]);

  }
}