<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class DeleteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function delete($id) {
    $student = Student::find($id);
    return view('delete',['student' => $student]);
  } 

  public function store(Request $request) {
    Validator::make($request->all(), [ 
      'g-recaptcha-response' => 'required|captcha',
      ],[
      'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
      ])->validate();
    
    $id = $request->input('id');
    $student = Student::find($id);
    $name = $student->name
    $student->delete();

    flash('Student <strong>' . $name . '</strong> was deleted!', 'success');
    return redirect()->action('StudentController@index'); 
  }      
}
