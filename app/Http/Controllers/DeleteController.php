<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function delete($id) {
        $student = DB::table('student')->where('id', $id)->get();
        if ($student->isEmpty()){
            return view('404');
        } else {
            return view('delete',['student' => $student->first()]);
        }        
    } 

    public function store(Request $request) {
		Validator::make($request->all(), [ 
            'id' => 'required|exists:student,id',
            'g-recaptcha-response' => 'required|captcha',
		],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ])->validate();
	
        $id = $request->input('id');
        $student = DB::table('student')->where('id', $id)->get();
        if ($student->isEmpty()){
            return view('404');
        } else {
            DB::table('student')
                ->where('id', $id)
                ->delete(); 
            return redirect()->action('StudentController@index');
        }
    }      
}
