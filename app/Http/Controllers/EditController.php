<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function edit($id) {
        $student = DB::table('student')->where('id', $id)->get();
        if ($student->isEmpty()){
            return view('404');
        } else {
            return view('edit',['student' => $student->first()]);
        }        
    } 

    public function store(Request $request) {
		Validator::make($request->all(), [ // as simple as this
			'nickname' => 'required|min:5|max:30',
			'fullname' => 'required|min:5|max:30',
			'kattisacct' => 'required|min:5|max:30',
			'nationality' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'mc' => array('required','regex:/^((([0-3][.][5])|[x]|([0-4]))($|,)){8}(([0-3][.][5])|[x]|([0-4]))$/'),
            'tc' => array('required','regex:/^(([0-9][.][5])|[x]|([0-9])|([1][0][.][5])|([1][0]))(,)(([0-9][.][5])|[x]|([0-9])|([1][0-3][.][05])|([1][0-3]))$/'),
            'hw' => array('required','regex:/^((([0-1][.][5])|[x]|([0-1]))($|,)){9}(([0-1][.][5])|[x]|([0-1]))$/'),
            'bs' => array('required','regex:/^(([0-1]|[x])($|,)){8}([0-1]|[x])$/'),
            'ks' => array('required','regex:/^(([0-1]|[x])($|,)){11}([0-1]|[x])$/'),
            'ac' => array('required','regex:/^(([0-6]|[x])($|,)){7}([0-6]|[x])$/'),
        ],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ]
		)->validate();
	
		$nickname = $request->input('nickname');
		$fullname = $request->input('fullname');
		$kattisacct = $request->input('kattisacct');
		$mc = $request->input('mc');
		$tc = $request->input('tc');
		$hw = $request->input('hw');
		$bs = $request->input('bs');
		$ks = $request->input('ks');
		$ac = $request->input('ac');
		$comment = $request->input('comment');
		$nationality = $request->input('nationality');
		$id = $request->input('id');
		DB::table('student')
			->where('id', $id)
			->update(
				['name' => $fullname, 'nickname' => $nickname, 'kattis' => $kattisacct,
				'mc' => $mc, 'tc' => $tc, 'hw' => $hw, 'bs' => $bs, 'country' => $nationality,
				'ks' => $ks, 'ac' => $ac, 'comment' => $comment]);
		
		return redirect()->action('StudentController@detail',['id' => $id]);
    }      
}
