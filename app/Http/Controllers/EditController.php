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
    $student = Student::find($id);
    return view('edit',['student' => $student]);
  } 

  public function store(Request $request) {
    Validator::make($request->all(), [
      'nickname' => 'required|min:3|max:30',
      'fullname' => 'required|min:3|max:30',
      'kattisacct' => 'required|min:3|max:30',
      'nationality' => 'required',
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