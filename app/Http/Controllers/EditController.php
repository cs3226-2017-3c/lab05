<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;

use Validator;

class EditController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');

  }

  public function upload($id) {
    if (!is_numeric($id)){
        return response()->view('errors/404',[],404);
    }
    $student = Student::find($id);
    if (!$student){
        return response()->view('errors/404',[],404);
    }
    if ($id != Auth::user()->student_id){
      return redirect('/');
    }
    return view('edit',['student' => $student]);
  } 

  public function store(Request $request) {
    Validator::make($request->all(), [
      'nickname' => array('required','min:5','max:30','regex:/^[A-Za-z1-9,._ ]+$/'),
      'fullname' => array('required','min:5','max:30','regex:/^[A-Za-z1-9,._ ]+$/'),
      'kattisacct' => array('required','min:5','max:30','regex:/^[A-Za-z1-9,._ ]+$/'),
      'nationality' => 'required',
      'comment' => array('max:500','regex:/^[A-Za-z1-9,._ ]+$/'),
      'avatar' => 'max:1024|image',
      ])->validate();
    $user_id = Auth::id();

    $id = $request->input('id');
    $student = Student::find($id);
    if($request->hasFile('avatar')){
      $path = $request->file('avatar')->store("public/avatar");
      $student->avatar = $path;
    }

    $student->nickname = $request->input('nickname');
    $student->name = $request->input('fullname');
    $student->kattis = $request->input('kattisacct');
    $student->comment = $request->input('comment');
    $student->country = $request->input('nationality');
    $student->updated_by = $user_id;

    $student->save();

    flash('Info of student <strong>' . $student->name . '</strong> was updated!', 'success');
    return redirect()->action('DetailController@detail',['id' => $id]);
  }     
}
