<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{

    public function upload($id) {
        $student = DB::table('student')->where('id', $id)->get();
        if ($student->isEmpty()){
            return view('404');
        } else {
            return view('upload',['student' => $student->first()]);
        }
    } 

    public function store(Request $request) {
        Validator::make($request->all(), [
            'avatar' => 'required|max:1024|mimetypes:image/jpeg,image/bmp,image/gif',
            'id' => 'required|exists:student,id',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ])->validate();

        $path = $request->file('avatar')->store("public/avatar");
        $id = $request->input('id');
        $student = DB::table('student')->where('id', $id)->get();
        if ($student->isEmpty()){
            return view('404');
        } else {
            DB::table('student')
                ->where('id', $id)
                ->update(['avatar' => $path]); 
            return redirect()->action('StudentController@detail',['id' => $id]);
        }
    }      
}
