<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;

class UploadController extends Controller
{

    public function upload($id) {
        $student = Student::find($id);
        return view('upload',['student' => $student]);
    } 

    public function store(Request $request) {
        Validator::make($request->all(), [
            'avatar' => 'required|max:1024|image',
            //'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ])->validate();
        $path = $request->file('avatar')->store("public/avatar");
        $id = $request->input('id');
        $student = Student::find($id);
        $student->avatar = $path;
        $student->save();

        return redirect()->action('DetailController@detail',['id' => $id]);
    }     
}
